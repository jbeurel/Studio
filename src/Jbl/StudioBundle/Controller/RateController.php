<?php

namespace Jbl\StudioBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Jbl\StudioBundle\Entity\Rate;
use Jbl\StudioBundle\Form\RateType;

/**
 * Rate controller.
 *
 */
class RateController extends Controller
{
    /**
     * Lists all Rate entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entities = $em->getRepository('JblStudioBundle:Rate')->findAll();

        return $this->render('JblStudioBundle:Rate:index.html.twig', array(
            'entities' => $entities
        ));
    }

    /**
     * Finds and displays a Rate entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('JblStudioBundle:Rate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Rate entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('JblStudioBundle:Rate:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),

        ));
    }

    /**
     * Displays a form to create a new Rate entity.
     *
     */
    public function newAction()
    {
        $entity = new Rate();
        $form   = $this->createForm(new RateType(), $entity);

        return $this->render('JblStudioBundle:Rate:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Creates a new Rate entity.
     *
     */
    public function createAction()
    {
        $entity  = new Rate();
        $request = $this->getRequest();
        $form    = $this->createForm(new RateType(), $entity);
        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('rate_show', array('id' => $entity->getId())));
            
        }

        return $this->render('JblStudioBundle:Rate:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView()
        ));
    }

    /**
     * Displays a form to edit an existing Rate entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('JblStudioBundle:Rate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Rate entity.');
        }

        $editForm = $this->createForm(new RateType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('JblStudioBundle:Rate:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Edits an existing Rate entity.
     *
     */
    public function updateAction($id)
    {
        $em = $this->getDoctrine()->getEntityManager();

        $entity = $em->getRepository('JblStudioBundle:Rate')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Rate entity.');
        }

        $editForm   = $this->createForm(new RateType(), $entity);
        $deleteForm = $this->createDeleteForm($id);

        $request = $this->getRequest();

        $editForm->bindRequest($request);

        if ($editForm->isValid()) {
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('rate'));
        }

        return $this->render('JblStudioBundle:Rate:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a Rate entity.
     *
     */
    public function deleteAction($id)
    {
        $form = $this->createDeleteForm($id);
        $request = $this->getRequest();

        $form->bindRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getEntityManager();
            $entity = $em->getRepository('JblStudioBundle:Rate')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Rate entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('rate'));
    }

    private function createDeleteForm($id)
    {
        return $this->createFormBuilder(array('id' => $id))
            ->add('id', 'hidden')
            ->getForm()
        ;
    }
}
