<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * VolunteerEnrolment
 *
 * @ORM\Table(name="volunteer_enrolment")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VolunteerEnrolmentRepository")
 */
class VolunteerEnrolment
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    /**
     * @var Emergency $emergency
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Emergency")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $emergency;
    /**
     * @var Volunteer $volunteer
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Volunteer")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $volunteer;
    /**
     * @var \DateTime $created
     *
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * VolunteerEnrolment constructor.
     */
    public function __construct()
    {
        $this->created = new \DateTime();
    }


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return Emergency
     */
    public function getEmergency()
    {
        return $this->emergency;
    }

    /**
     * @param Emergency $emergency
     */
    public function setEmergency($emergency)
    {
        $this->emergency = $emergency;
    }

    /**
     * @return Volunteer
     */
    public function getVolunteer()
    {
        return $this->volunteer;
    }

    /**
     * @param Volunteer $volunteer
     */
    public function setVolunteer($volunteer)
    {
        $this->volunteer = $volunteer;
    }

    /**
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * @param \DateTime $created
     */
    public function setCreated($created)
    {
        $this->created = $created;
    }

}

