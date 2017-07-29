<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Emergency;
use AppBundle\Entity\Volunteer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * @Route("/api/v1")
 */
class DataController extends AppController
{
    /**
     * @Route("/", name="api_volunteer_list")
     * @Method("GET")
     */
    public function listVolunteerAction()
    {
        $data = $this->em()->getRepository(Volunteer::class)->findAll();
        return $this->renderJSON($data);
    }

    /**
     * @Route("/", name="api_emergency_list")
     * @Method("GET")
     */
    public function listEmergencyAction()
    {
        $data = $this->em()->getRepository(Emergency::class)->findAll();
        return $this->renderJSON($data);
    }
}
