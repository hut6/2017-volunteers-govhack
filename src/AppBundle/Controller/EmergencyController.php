<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Emergency;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Emergency controller.
 *
 * @Route("emergency")
 */
class EmergencyController extends Controller
{
    /**
     * Lists all emergency entities.
     *
     * @Route("/", name="emergency_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $emergencies = $em->getRepository('AppBundle:Emergency')->findAll();

        return $this->render('emergency/index.html.twig', array(
            'emergencies' => $emergencies,
        ));
    }

    /**
     * Creates a new emergency entity.
     *
     * @Route("/new", name="emergency_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $emergency = new Emergency();
        $form = $this->createForm('AppBundle\Form\EmergencyType', $emergency);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($emergency);
            $em->flush();

            return $this->redirectToRoute('emergency_show', array('id' => $emergency->getId()));
        }

        return $this->render('emergency/new.html.twig', array(
            'emergency' => $emergency,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a emergency entity.
     *
     * @Route("/{id}", name="emergency_show")
     * @Method("GET")
     */
    public function showAction(Emergency $emergency)
    {
        $deleteForm = $this->createDeleteForm($emergency);

        return $this->render('emergency/show.html.twig', array(
            'emergency' => $emergency,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing emergency entity.
     *
     * @Route("/{id}/edit", name="emergency_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Emergency $emergency)
    {
        $deleteForm = $this->createDeleteForm($emergency);
        $editForm = $this->createForm('AppBundle\Form\EmergencyType', $emergency);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('emergency_edit', array('id' => $emergency->getId()));
        }

        return $this->render('emergency/edit.html.twig', array(
            'emergency' => $emergency,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a emergency entity.
     *
     * @Route("/{id}", name="emergency_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Emergency $emergency)
    {
        $form = $this->createDeleteForm($emergency);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($emergency);
            $em->flush();
        }

        return $this->redirectToRoute('emergency_index');
    }

    /**
     * Creates a form to delete a emergency entity.
     *
     * @param Emergency $emergency The emergency entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Emergency $emergency)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('emergency_delete', array('id' => $emergency->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
