<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Emergency;
use AppBundle\Entity\Volunteer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

/**
 * @Route("/api/v1")
 */
class DataController extends AppController
{
    /**
     * @Route("/volunteer", name="api_volunteer_list")
     * @Method("GET")
     * @Security("is_granted('ROLE_ADMIN')")
     */
    public function listVolunteerAction()
    {
        $data = $this->em()->getRepository(Volunteer::class)->findAll();
        return $this->renderJSON($data);
    }

    /**
     * @Route("/emergencies", name="api_emergency_list")
     * @Method("GET")
     */
    public function listEmergencyAction()
    {
        $data = $this->em()->getRepository(Emergency::class)->findAll();
        return $this->renderJSON($data);
    }
}
