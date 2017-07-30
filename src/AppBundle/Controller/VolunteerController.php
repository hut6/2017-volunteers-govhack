<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Volunteer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Volunteer controller.
 *
 * @Route("volunteer")
 */
class VolunteerController extends AppController
{
    /**
     * Lists all volunteer entities.
     *
     * @Route("/", name="volunteer_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        if($request->get('skill')) {
            $volunteers = $em->getRepository(Volunteer::class)->findBySkills([$request->get('skill')]);
        } else {
            $volunteers = $em->getRepository(Volunteer::class)->findAll();
        }

        return $this->render('volunteer/index.html.twig', array(
            'volunteers' => $volunteers,
            'skills' => $this->em()->getRepository("AppBundle:Skill")->findAll()
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

            return $this->redirectToRoute('volunteer_index');
        }

        return $this->render('volunteer/new.html.twig', array(
            'volunteer' => $volunteer,
            'form' => $form->createView(),
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
        $editForm = $this->createForm('AppBundle\Form\VolunteerType', $volunteer);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('volunteer_index');
        }

        return $this->render('volunteer/edit.html.twig', array(
            'volunteer' => $volunteer,
            'edit_form' => $editForm->createView(),
        ));
    }

}
