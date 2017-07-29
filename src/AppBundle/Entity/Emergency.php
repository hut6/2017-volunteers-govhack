<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Emergency
 *
 * @ORM\Table(name="emergency")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\EmergencyRepository")
 */
class Emergency implements \JsonSerializable
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
     * @ORM\Column(name="description", type="string", length=255)
     */
    private $description;

    /**
     * @var Skill[]|Collection
     *
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Skill", inversedBy="emergencies", cascade={"persist"})
     * @ORM\JoinTable()
     */
    private $skills;

    /**
     * @var EmergencyType[]|Collection
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Skill", inversedBy="emergencies", cascade={"persist"})
     */
    private $emergencyType;

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
     * Set description
     *
     * @param string $description
     *
     * @return Emergency
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
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

    public function jsonSerialize()
    {
        return [];
    }

}

