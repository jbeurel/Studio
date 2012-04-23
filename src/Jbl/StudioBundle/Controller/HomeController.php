<?php

namespace Jbl\StudioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Jbl\StudioBundle\Entity\Contactmail;

class HomeController extends Controller
{
    public function indexAction()
    {
    	
    	$em = $this->getDoctrine()->getEntityManager();
    	
    	$phone = $em->getRepository('JblStudioBundle:Phone')->find(1);
    	
    	$contactmail = new Contactmail();
    	
    	$formBuilder = $this->createFormBuilder($contactmail);
    	
		$formBuilder
			->add('fromMail', 'email')
			->add('name', 'text', array('required' => false))
			->add('message', 'textarea')
			->add('phone', 'text', array('required' => false));
		
		$form = $formBuilder->getForm();
		
		$request = $this->get('request');
		
		if( $request->getMethod() == 'POST' )
		{
			// Bind Request <-> Form
			$form->bindRequest($request);
		
			if( $form->isValid() )
			{
				
				$validcontactmail = $form->getData();
				
				// Mail send
				$message = \Swift_Message::newInstance()
				->setSubject(
					$this->container->getParameter('jbl_studio.website_name')
					. ' - ('
					. $validcontactmail->getName()
					. ')'
				)
				->setFrom(array($validcontactmail->getFromMail() => 'Formulaire ' . $this->container->getParameter('jbl_studio.website_name')))
				->setTo($this->container->getParameter('jbl_studio.website_email'))
				->setBody(
					$this->renderView(
						'JblStudioBundle:Home:email.html.twig', 
						array(
							'message' => $validcontactmail->getMessage(),
							'email' => $validcontactmail->getFromMail(),
							'name' => $validcontactmail->getName(),
							'phone' => $validcontactmail->getPhone()
						)), 
						'text/html'
					);
				$this->get('mailer')->send($message);
				
				// Form cleaned
				$form->setData(new Contactmail());
				
				return $this->render('JblStudioBundle:Home:index.html.twig', array(
				'form' => $form->createView(),
				'formIsSend' => true,
				'phoneAvailable' => $phone->getAvailable(),
				));
			}
		}
		
        return $this->render('JblStudioBundle:Home:index.html.twig', array(
        	'form' => $form->createView(),
        	'formIsSend' => false,
        	'phoneAvailable' => $phone->getAvailable(),
        ));
    }
}
