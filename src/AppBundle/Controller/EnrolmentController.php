<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Emergency;
use AppBundle\Entity\VolunteerEnrolment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class EnrolmentController
 * @package AppBundle\Controller
 */
class EnrolmentController extends AppController
{
    /**
     * @Route("/list/{id}")
     */
    public function listAction(Emergency $emergency)
    {
        $volunteers = $this->em()->getRepository("AppBundle:Volunteer")->findUnenrolledBySkills($emergency, $emergency->getSkills());

        $this->enrolVolunteers($emergency, $volunteers);

        return $this->render(':enrolment:list.html.twig', [
            "emergency" => $emergency,
        ]);
    }

    /**
     * @Route("/confirm-enrolment/{id}")
     */
    public function confirmAction(VolunteerEnrolment $enrolment)
    {
        $enrolment->setConfirmed(1);

        $this->em()->flush();

        return $this->redirectToRoute('app_enrolment_list', [
            "id" => $enrolment->getEmergency()->getId(),
        ]);
    }

    /**
     * @param Emergency $emergency
     * @param $volunteers
     */
    private function enrolVolunteers (Emergency $emergency, $volunteers) {

        foreach ($volunteers as $volunteer) {
            $enrolment = new VolunteerEnrolment(
                $emergency,
                $volunteer
            );
            $this->em()->persist($enrolment);
        }

        $this->em()->flush();
    }

    /**
     * @Route("/cancel-enrolment/{id}")
     */
    public function cancelAction(VolunteerEnrolment $enrolment)
    {
        $enrolment->setConfirmed(0);

        $this->em()->flush();

        return $this->redirectToRoute('app_enrolment_list', [
            "id" => $enrolment->getEmergency()->getId(),
        ]);

    }

    /**
     * @Route("/cancel-all/{id}")
     */
    public function cancelAllAction(Emergency $emergency)
    {

        $enrolments = $this->em()->getRepository("AppBundle:VolunteerEnrolment")->getUnconfirmedVolunteers($emergency);

        foreach ($enrolments as $enrolment) {
            $enrolment->setConfirmed(false);
        }

        $this->em()->flush();

        return $this->redirectToRoute('app_enrolment_list', [
            "id" => $emergency->getId(),
        ]);

    }

    /**
     * @Route("/cancel-skill-enrolments/{id}")
     */
    public function cancelSkillAction(Emergency $emergency, Request $request)
    {

        $enrolments = $this->em()->getRepository("AppBundle:VolunteerEnrolment")->getEnrolledVolunteers(
            $emergency,
            $request->get("skill")
        );

        foreach ($enrolments as $enrolment) {
            $enrolment->setConfirmed(false);
        }

        $this->em()->flush();

        return $this->redirectToRoute('app_enrolment_list', [
            "id" => $emergency->getId(),
        ]);

    }

}
