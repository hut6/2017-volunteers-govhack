<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Emergency;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class EnrolmentController extends Controller
{
    /**
     * @Route("/list/{id}")
     */
    public function listAction(Emergency $emergency)
    {
        return $this->render(':enrolment:list.html.twig', [
            "emergency" => $emergency,
        ]);
    }

}
