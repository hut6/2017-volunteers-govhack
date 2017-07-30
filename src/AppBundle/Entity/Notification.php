<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Notification
 *
 * @ORM\Table(name="notification")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\NotificationRepository")
 */
class Notification implements \JsonSerializable
{
    const TYPE_GENERAL = 'general';
    const TYPE_WARNING = 'warning';
    const TYPE_ENROLMENT_NEW = 'new_enrollment';
    const TYPE_ENROLMENT_REJECT = 'reject';
    const TYPE_ENROLMENT_CANCEL = 'cancel';
    const TYPE_ENROLMENT_CONFIRM = 'confirm';

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var VolunteerEnrolment
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\VolunteerEnrolment")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $enrolment;

    /**
     * @var Volunteer
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Volunteer")
     * @ORM\JoinColumn(onDelete="CASCADE")
     */
    private $volunteer;

    /**
     * @var string
     *
     * @ORM\Column(type="string", nullable=false)
     */
    private $notificationType;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $seen;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $sent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $created;

    /**
     * Notification constructor.
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
     * @return VolunteerEnrolment
     */
    public function getEnrolment()
    {
        return $this->enrolment;
    }

    /**
     * @param VolunteerEnrolment $enrolment
     */
    public function setEnrolment(VolunteerEnrolment $enrolment)
    {
        $this->enrolment = $enrolment;
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
    public function setVolunteer(Volunteer $volunteer)
    {
        $this->volunteer = $volunteer;
    }

    /**
     * @return string
     */
    public function getNotificationType()
    {
        return $this->notificationType;
    }

    /**
     * @param string $notificationType
     */
    public function setNotificationType(string $notificationType)
    {
        $this->notificationType = $notificationType;
    }

    /**
     * @return \DateTime
     */
    public function getSeen()
    {
        return $this->seen;
    }

    /**
     * @param \DateTime $seen
     */
    public function setSeen(\DateTime $seen)
    {
        $this->seen = $seen;
    }

    /**
     * @return \DateTime
     */
    public function getSent()
    {
        return $this->sent;
    }

    /**
     * @param \DateTime $sent
     */
    public function setSent(\DateTime $sent)
    {
        $this->sent = $sent;
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
    public function setCreated(\DateTime $created)
    {
        $this->created = $created;
    }

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'enrollment' => $this->getEnrolment(),
            'category' => $this->getNotificationType(),
            'sent' => $this->getSent(),
            'read' => $this->getSent(),
            'created' => $this->getCreated(),
        ];
    }

}

