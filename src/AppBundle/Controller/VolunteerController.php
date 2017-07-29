<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Volunteer;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Volunteer controller.
 *
 * @Route("volunteer")
 */
class VolunteerController extends Controller
{
    /**
     * Lists all volunteer entities.
     *
     * @Route("/", name="volunteer_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $volunteers = $em->getRepository('AppBundle:Volunteer')->findAll();

        return $this->render('volunteer/index.html.twig', array(
            'volunteers' => $volunteers,
        ));
    }

    /**
     * Creates a new volunteer entity.
     *
     * @Route("/new", name="volunteer_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $volunteer = new Volunteer();
        $form = $this->createForm('AppBundle\Form\VolunteerType', $volunteer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($volunteer);
            $em->flush();

            return $this->redirectToRoute('volunteer_show', array('id' => $volunteer->getId()));
        }

        return $this->render('volunteer/new.html.twig', array(
            'volunteer' => $volunteer,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a volunteer entity.
     *
     * @Route("/{id}", name="volunteer_show")
     * @Method("GET")
     */
    public function showAction(Volunteer $volunteer)
    {
        $deleteForm = $this->createDeleteForm($volunteer);

        return $this->render('volunteer/show.html.twig', array(
            'volunteer' => $volunteer,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing volunteer entity.
     *
     * @Route("/{id}/edit", name="volunteer_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Volunteer $volunteer)
    {
        $deleteForm = $this->createDeleteForm($volunteer);
        $editForm = $this->createForm('AppBundle\Form\VolunteerType', $volunteer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('volunteer_edit', array('id' => $volunteer->getId()));
        }

        return $this->render('volunteer/edit.html.twig', array(
            'volunteer' => $volunteer,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a volunteer entity.
     *
     * @Route("/{id}", name="volunteer_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Volunteer $volunteer)
    {
        $form = $this->createDeleteForm($volunteer);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($volunteer);
            $em->flush();
        }

        return $this->redirectToRoute('volunteer_index');
    }

    /**
     * Creates a form to delete a volunteer entity.
     *
     * @param Volunteer $volunteer The volunteer entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Volunteer $volunteer)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('volunteer_delete', array('id' => $volunteer->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
