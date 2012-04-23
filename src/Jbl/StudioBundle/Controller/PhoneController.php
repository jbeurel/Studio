<?php

namespace Jbl\StudioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Jbl\StudioBundle\Entity\Phone;
use Jbl\StudioBundle\Form\PhoneType;

/**
 * Phone controller.
 *
 */
class PhoneController extends Controller
{
    /**
     * Lists all Phone entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('JblStudioBundle:Phone')->findAll();

        return $this->render('JblStudioBundle:Phone:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Phone entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('JblStudioBundle:Phone')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Phone entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('JblStudioBundle:Phone:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Phone entity.
     *
     */
    public function newAction()
    {
        $entity = new Phone();
        $form   = $this->createForm(new PhoneType(), $entity);

        return $this->render('JblStudioBundle:Phone:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Phone entity.
     *
     */
    public function createAction()
    {
        $entity  = new Phone();
        $request = $this->getRequest();
        $form    = $this->createForm(new PhoneType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('phone_show', array('id' => $entity->getId())));
            
        }

        return $this->render('JblStudioBundle:Phone:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Phone entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('JblStudioBundle:Phone')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Phone entity.');
        }

        $editForm = $this->createForm(new PhoneType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('JblStudioBundle:Phone:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Phone entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('JblStudioBundle:Phone')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Phone entity.');
        }

        $editForm   = $this->createForm(new PhoneType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('phone_edit', array('id' => $id)));
        }

        return $this->render('JblStudioBundle:Phone:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Phone entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('JblStudioBundle:Phone')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Phone entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('phone'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
    
    public function switchAction()
    {
    	$id=1;
    	
    	$em = $this->getDoctrine()->getEntityManager();
    
    	$entity = $em->getRepository('JblStudioBundle:Phone')->find($id);
    
    	if (!$entity) {
    		throw $this->createNotFoundException('Unable to find Phone entity.');
    	}
    
    	$editForm = $this->createForm(new PhoneType(), $entity);
    
    	return $this->render('JblStudioBundle:Phone:switch.html.twig', array(
		    'entity'      => $entity,
		    'edit_form'   => $editForm->createView(),
	    ));
    }
    
    /**
     * Edits an existing Phone entity.
     *
     */
    public function switchconfirmationAction()
    {
    	$id=1;
    	
    	$em = $this->getDoctrine()->getEntityManager();
    
    	$entity = $em->getRepository('JblStudioBundle:Phone')->find($id);
    
    	if (!$entity) {
    		throw $this->createNotFoundException('Unable to find Phone entity.');
    	}
    
    	$editForm   = $this->createForm(new PhoneType(), $entity);
    
    	$request = $this->getRequest();
    
    	$editForm->bindRequest($request);
    
    	if ($editForm->isValid()) {
    		$em->persist($entity);
    		$em->flush();
    	}    
    
    	return $this->render('JblStudioBundle:Phone:switch.html.twig', array(
		    'entity'      => $entity,
		    'edit_form'   => $editForm->createView(),
	    ));
    }
}
