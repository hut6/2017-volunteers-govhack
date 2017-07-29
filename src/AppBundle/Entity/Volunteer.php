<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Volunteer
 *
 * @ORM\Table(name="volunteer")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\VolunteerRepository")
 */
class Volunteer
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
}

