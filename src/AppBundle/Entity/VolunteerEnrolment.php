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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Volunteer", inversedBy="enrolments")
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
     * @var boolean $canDoIt
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $canDoIt;

    /**
     * @var boolean $canDoItDateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $canDoItDateTime;

    /**
     * @var boolean $cconfirmed
     *
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $confirmed;

    /**
     * @var boolean $confirmedDateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $confirmedDateTime;

    /**
     * VolunteerEnrolment constructor.
     * @param Emergency $emergency
     * @param Volunteer $volunteer
     */
    public function __construct(Emergency $emergency, Volunteer $volunteer)
    {
        $this->emergency = $emergency;
        $this->volunteer = $volunteer;
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

    /**
     * @return bool
     */
    public function isCanDoIt()
    {
        return $this->canDoIt;
    }

    /**
     * @param bool $canDoIt
     */
    public function setCanDoIt($canDoIt)
    {
        $this->canDoIt = $canDoIt;
    }

    /**
     * @return bool
     */
    public function isCanDoItDateTime()
    {
        return $this->canDoItDateTime;
    }

    /**
     * @param bool $canDoItDateTime
     */
    public function setCanDoItDateTime($canDoItDateTime)
    {
        $this->canDoItDateTime = $canDoItDateTime;
    }

    /**
     * @return bool
     */
    public function isConfirmed()
    {
        return $this->confirmed;
    }

    /**
     * @param bool $confirmed
     */
    public function setConfirmed($confirmed)
    {
        $this->confirmed = $confirmed;
    }

    /**
     * @return bool
     */
    public function isConfirmedDateTime()
    {
        return $this->confirmedDateTime;
    }

    /**
     * @param bool $confirmedDateTime
     */
    public function setConfirmedDateTime($confirmedDateTime)
    {
        $this->confirmedDateTime = $confirmedDateTime;
    }

}

