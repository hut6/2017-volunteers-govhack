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
    const TYPE_ENROLMENT_ACCEPT = 'accept';
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
     * @ORM\Column(type="string")
     */
    private $type;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $read;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $sent;

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
    public function getEnrolment(): VolunteerEnrolment
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
    public function getVolunteer(): Volunteer
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
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @param string $type
     */
    public function setType(string $type)
    {
        $this->type = $type;
    }

    /**
     * @return \DateTime
     */
    public function getRead(): \DateTime
    {
        return $this->read;
    }

    /**
     * @param \DateTime $read
     */
    public function setRead(\DateTime $read)
    {
        $this->read = $read;
    }

    /**
     * @return \DateTime
     */
    public function getSent(): \DateTime
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

    public function jsonSerialize()
    {
        return [
            'id' => $this->getId(),
            'enrolment' => $this->getEnrolment(),
            'type' => $this->getType(),
            'sent' => $this->getSent(),
        ];
    }

}

