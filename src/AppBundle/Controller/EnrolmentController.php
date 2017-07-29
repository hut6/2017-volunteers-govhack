<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Emergency;
use AppBundle\Entity\VolunteerEnrolment;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class EnrolmentController extends AppController
{
    /**
     * @Route("/list/{id}")
     */
    public function listAction(Emergency $emergency)
    {
        $volunteers = $this->em()->getRepository("AppBundle:Volunteer")->findUnenrolledBySkills($emergency, $emergency->getSkills());

        foreach ($volunteers as $volunteer) {
            $enrolment = new VolunteerEnrolment(
                $emergency,
                $volunteer
            );
            $this->em()->persist($enrolment);
        }

        $this->em()->flush();

        return $this->render(':enrolment:list.html.twig', [
            "emergency" => $emergency,
        ]);
    }

    /**
     * @Route("/confirm-enrolment/{id}")
     */
    public function confirmAction(VolunteerEnrolment $enrolment)
    {
        $enrolment->setConfirmed(true);
    }

}
