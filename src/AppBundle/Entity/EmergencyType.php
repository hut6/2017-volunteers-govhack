<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * EmergencyType
 *
 * @ORM\Table(name="emergency_type")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SkillRepository")
 */
class EmergencyType
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var Emergency[]|Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Emergency", mappedBy="emergencyType", cascade={"persist"})
     * @ORM\JoinTable()
     */
    private $emergencies;

    /**
     * Volunteer constructor.
     */
    public function __construct()
    {
        $this->created = new \DateTime();
    }

    function __toString()
    {
        return $this->name;
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
     * Set name
     *
     * @param string $name
     *
     * @return Skill
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
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
     * @return Emergency[]|Collection
     */
    public function getEmergencies()
    {
        return $this->emergencies;
    }

    /**
     * @param Emergency[]|Collection $emergencies
     */
    public function setEmergencies($emergencies)
    {
        $this->emergencies = $emergencies;
    }

}

