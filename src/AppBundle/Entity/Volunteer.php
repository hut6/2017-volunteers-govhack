<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Volunteer
 *
 * @ORM\Table(name="volunteer")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VolunteerRepository")
 */
class Volunteer implements \JsonSerializable
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
     * @var \DateTime $created
     *
     * @ORM\Column(type="datetime")
     */
    private $created;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="phone", type="string", length=255, nullable=true)
     */
    private $phone;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;

    /**
     * @var Skill[]|Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Skill", inversedBy="emergencies", cascade={"persist"})
     * @ORM\JoinTable()
     */
    private $skills;

    /**
     * @var VolunteerEnrolment[]|Collection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\VolunteerEnrolment", mappedBy="volunteer", cascade={"persist"})
     */
    private $enrolments;

    /**
     * Volunteer constructor.
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
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * @return Skill[]|Collection
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * @param Skill[]|Collection $skills
     */
    public function setSkills($skills)
    {
        $this->skills = $skills;
    }

    /**
     * @return VolunteerEnrolment[]|Collection
     */
    public function getEnrolments()
    {
        return $this->enrolments;
    }

    /**
     * @param VolunteerEnrolment[]|Collection $enrolments
     */
    public function setEnrolments($enrolments)
    {
        $this->enrolments = $enrolments;
    }

    /**
     * @return string
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param string $phone
     */
    public function setPhone($phone)
    {
        $this->phone = $phone;
    }

    public function jsonSerialize()
    {
        return [
            'name' => $this->getName(),
            'email' => $this->getEmail(),
            'skills' => $this->getSkills(),
        ];
    }
}

