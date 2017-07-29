<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Emergency;
use AppBundle\Entity\VolunteerEnrolment;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Emergency controller.
 *
 * @Route("emergency")
 */
class EmergencyController extends AppController
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

        $emergencies = $em->getRepository(Emergency::class)->findAll();

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

            $volunteers = $em->getRepository("AppBundle:Volunteer")->findBySkills($emergency->getSkills());

            foreach ($volunteers as $volunteer) {
                $enrolment = new VolunteerEnrolment(
                    $emergency,
                    $volunteer
                );
                $em->persist($enrolment);
            }

            $em->flush();

            return $this->redirectToRoute('emergency_index');
        }

        return $this->render('emergency/new.html.twig', array(
            'emergency' => $emergency,
            'form' => $form->createView(),
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
        $editForm = $this->createForm('AppBundle\Form\EmergencyType', $emergency);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('emergency_index');
        }

        return $this->render('emergency/edit.html.twig', array(
            'emergency' => $emergency,
            'edit_form' => $editForm->createView(),
        ));
    }
}
