<?php

namespace Jbl\StudioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Jbl\StudioBundle\Entity\Week;
use Jbl\StudioBundle\Form\WeekType;
use Jbl\StudioBundle\Entity\Rate;

/**
 * Week controller.
 *
 */
class WeekController extends Controller
{
    /**
     * Lists all Week entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('JblStudioBundle:Week')->findAll();

        return $this->render('JblStudioBundle:Week:index.html.twig', array(
            'entities' => $entities
        ));
    }
    
    /**
     * Lists all Week entities.
     *
     */
    public function calendarAction()
    {
    	$request = $this->getRequest();
    	$timestamp = $request->get('timestamp');
    	
    	$dateTargetMonth = -1;
    	$dateTargetYear = -1;
    	
    	if ($timestamp != -1) {
    		$dateTargetMonth = date('m',$timestamp)-1;
    		$dateTargetYear = date('Y',$timestamp);
    	}
    	
    	$em = $this->getDoctrine()->getEntityManager();
    
    	$rates = $em->getRepository('JblStudioBundle:Rate')->findAll();
    
    	return $this->render('JblStudioBundle:Week:calendar.html.twig', array(
	    	'rates' => $rates,
	    	'dateTargetMonth' => $dateTargetMonth,
	    	'dateTargetYear' => $dateTargetYear
	    ));
    }
    
    /**
     * Lists all Week entities on Json format.
     *
     */
    public function jsonlistAction()
    {
    	$request = $this->getRequest();
    	
    	$startParam = $request->query->get('start');
    	$endParam = $request->query->get('end');
    	
    	$em = $this->getDoctrine()->getEntityManager();
    
    	$weeks = $em->getRepository('JblStudioBundle:Week')->getByTimestamp($startParam, $endParam);
    	
    	return $this->render('JblStudioBundle:Week:list.json.twig', array(
	    'weeks' => $weeks
	    ));
    }

    /**
     * Lists all Week entities on Json format.
     *
     */
    public function jsonlistadminAction()
    {
    	$request = $this->getRequest();
    
    	$startParam = $request->query->get('start');
    	$endParam = $request->query->get('end');
    
    	$em = $this->getDoctrine()->getEntityManager();
    
    	$weeks = $em->getRepository('JblStudioBundle:Week')->getByTimestamp($startParam, $endParam);
    
    	return $this->render('JblStudioBundle:Week:listadmin.json.twig', array(
	    'weeks' => $weeks
	    ));
    }
    
    /**
     * Finds and displays a Week entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('JblStudioBundle:Week')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Week entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('JblStudioBundle:Week:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Week entity.
     *
     */
    public function newAction()
    {
    	$request = $this->getRequest();
    	$timestamp = $request->get('timestamp');
    	

    	// Sélection des bons jours de fin de début de semaine
    	while (date("w", $timestamp) != 6) {
    	
    		$timestamp = $timestamp - 86400;
    	}
    	
    	$startDate = date('d/m/Y', $timestamp);
    	$endDate = date('d/m/Y', $timestamp+(86400*6));
    	
    	$em = $this->getDoctrine()->getEntityManager();
    	$rates = $em->getRepository('JblStudioBundle:Rate')->findAll();
    	
    
    	return $this->render('JblStudioBundle:Week:new.html.twig', array(
    	'rates' => $rates,
    	'timestamp' => $timestamp,
    	'startDate' => $startDate,
    	'endDate' => $endDate
	    ));
    }
    
    /**
     * Creates a new Week entity.
     *
     */
    public function createAction()
    {
    	
    	// Récupération des paramètres
    	$request = $this->getRequest();
    	$rateChoice = $request->request->get('rate');
    	$timestamp = $request->request->get('timestamp');
    	
    	
    	// Vérification du paramètre "rate"
    	$em = $this->getDoctrine()->getEntityManager();
    	
    	$rates = $em->getRepository('JblStudioBundle:Rate')->findAll();
    	
    	$valid = false;
    	
	    foreach($rates as $rate)
		{
			if ($rate->getId() == $rateChoice) $valid = true;
		}
		
		// Sélection des bons jours de fin de début de semaine
		while (date("w", $timestamp) != 6) {
			
			$timestamp = $timestamp - 86400;
		}

		$startDateTime = new \DateTime(date('Y-m-d', $timestamp));
		$endDateTime = new \DateTime(date('Y-m-d', $timestamp+(86400*6)));

		// Création de l'entité Week
    	$week  = new Week();
    	$week->setStart($startDateTime);
    	$week->setEnd($endDateTime);
    	$week->setIsFree(true);
    	$week->setRate($em->find('JblStudioBundle:Rate', $rateChoice));
    	
    	
    	if ($valid) {
    		$em = $this->getDoctrine()->getEntityManager();
    		$em->persist($week);
    		$em->flush();
    
    		return $this->redirect($this->generateUrl('week_calendar', array('timestamp'=> $timestamp)));
    
    	}
    
		return $this->render('JblStudioBundle:Week:new.html.twig', array(
	    	'rates' => $rates,
	    	'timestamp' => $timestamp
	    ));
    }
  
    /**
     * Displays a form to edit an existing Week entity.
     *
     */
    public function editAction($id)
    {
    	$em = $this->getDoctrine()->getEntityManager();
    
    	$entity = $em->getRepository('JblStudioBundle:Week')->find($id);
    
    	if (!$entity) {
    		throw $this->createNotFoundException('Unable to find Week entity.');
    	}
    	
    	$editForm = $this->createForm(new WeekType(), $entity);
    	$deleteForm = $this->createDeleteForm($id);
    
    	return $this->render('JblStudioBundle:Week:edit.html.twig', array(
	    'entity'      => $entity,
	    'edit_form'   => $editForm->createView(),
	    'delete_form' => $deleteForm->createView(),
	    ));
    }
    
    /**
     * Edits an existing Week entity.
     *
     */
    public function updateAction($id)
    {
    	$em = $this->getDoctrine()->getEntityManager();
    
    	$entity = $em->getRepository('JblStudioBundle:Week')->find($id);
    
    	if (!$entity) {
    		throw $this->createNotFoundException('Unable to find Week entity.');
    	}
    
    	$editForm   = $this->createForm(new WeekType(), $entity);
    	$deleteForm = $this->createDeleteForm($id);
    
    	$request = $this->getRequest();
    
    	$editForm->bindRequest($request);
    
    	if ($editForm->isValid()) {
    		$em->persist($entity);
    		$em->flush();
    
    		return $this->redirect($this->generateUrl('week_edit', array('id' => $id)));
    	}
    
    	return $this->render('JblStudioBundle:Week:edit.html.twig', array(
	    'entity'      => $entity,
	    'edit_form'   => $editForm->createView(),
	    'delete_form' => $deleteForm->createView(),
	    ));
    }
    
    /**
     * Deletes a Week entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('JblStudioBundle:Week')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Week entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('week'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    /**
     * Reserves a new Week entity.
     *
     */
    public function reserveAction($timestamp)
    {
    	$em = $this->getDoctrine()->getEntityManager();
    	
    	$week = $em->getRepository('JblStudioBundle:Week')->findByStartTimestamp($timestamp);
    	
    	if (!$week) {
    		throw $this->createNotFoundException('Impossible de trouver cette semaine.');
    	}
    	
    	$editForm = $this->createForm(new WeekType(), $week);
    	
    	return $this->render('JblStudioBundle:Week:reserve.html.twig', array(
	    	'week'      => $week,
	    	'edit_form' => $editForm->createView(),
    	));
    	
    }
    
    public function reserveValidationAction($id)
    {
    	$em = $this->getDoctrine()->getEntityManager();
    	
    	$week = $em->getRepository('JblStudioBundle:Week')->find($id);
    	
    	if (!$week) {
    		throw $this->createNotFoundException('Impossible de trouver cette semaine.');
    	}
    	
    	$editForm   = $this->createForm(new WeekType(), $week);
    	
    	$request = $this->getRequest();
    	
    	$editForm->bindRequest($request);
    	
    	if ($editForm->isValid()) {
    		$week->setIsFree(false);
    		$em->persist($week);
    		$em->flush();
    	
    		return $this->redirect($this->generateUrl('week_calendar', array('timestamp' => $week->getStart()->getTimestamp())));
    	}
    	
    	return $this->render('JblStudioBundle:Week:reserve.html.twig', array(
    	'week'      => $week,
    	'edit_form'   => $editForm->createView(),
    	));
    }

    public function reserveCancellationAction($id)
    {
    	$em = $this->getDoctrine()->getEntityManager();
    
    	$week = $em->getRepository('JblStudioBundle:Week')->find($id);
    
    	if (!$week) {
    		throw $this->createNotFoundException('Impossible de trouver cette semaine.');
    	}
    
		$week->setIsFree(true);
		$week->setContact(null);

		$em->persist($week);
		$em->flush();
    
		return $this->redirect($this->generateUrl('week_calendar', array('timestamp' => $week->getStart()->getTimestamp())));
    }
    
    public function rateAction($timestamp)
    {
    	$em = $this->getDoctrine()->getEntityManager();
    	
    	$week = $em->getRepository('JblStudioBundle:Week')->findByStartTimestamp($timestamp);
    	
    	if (!$week) {
    		throw $this->createNotFoundException('Impossible de trouver cette semaine.');
    	}
    	
    	$form = $this->createformBuilder($week)
    		->add('rate', 'entity', array('class' => 'JblStudioBundle:Rate', 'property' => 'value'))
    		->getForm();
    	
    	return $this->render('JblStudioBundle:Week:rate.html.twig', array(
	    	'form' => $form->createView(),
	    	'week' => $week,
    	));
    }
    
    public function rateValidationAction($id)
    {
    	$em = $this->getDoctrine()->getEntityManager();
    	
    	$week = $em->getRepository('JblStudioBundle:Week')->find($id);
    	
    	if (!$week) {
    		throw $this->createNotFoundException('Impossible de trouver cette semaine.');
    	}
    	
    	$form = $this->createformBuilder($week)
    	->add('rate', 'entity', array('class' => 'JblStudioBundle:Rate', 'property' => 'value'))
    	->getForm();
    	
        $request = $this->getRequest();
    	
    	$form->bindRequest($request);
    	
		$em->persist($week);
		$em->flush();
    	
		return $this->redirect($this->generateUrl('week_calendar', array('timestamp' => $week->getStart()->getTimestamp())));
    }
    
}
