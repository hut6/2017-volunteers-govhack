<?php

namespace AppBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Oh\GoogleMapFormTypeBundle\Validator\Constraints as OhAssert;

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
     * @var EmergencyType
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\EmergencyType", inversedBy="emergencies", cascade={"persist"})
     */
    private $emergencyType;

    /**
     * @var VolunteerEnrolment[]|Collection
     *
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\VolunteerEnrolment", mappedBy="emergency", cascade={"persist"})
     */
    private $enrolments;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lat;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $lon;

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

    /**
     * @return EmergencyType
     */
    public function getEmergencyType()
    {
        return $this->emergencyType;
    }

    /**
     * @param EmergencyType[]|Collection $emergencyType
     */
    public function setEmergencyType($emergencyType)
    {
        $this->emergencyType = $emergencyType;
    }

    /**
     * @return string
     */
    public function getLat()
    {
        return $this->lat;
    }

    /**
     * @param string $lat
     */
    public function setLat($lat)
    {
        $this->lat = $lat;
    }

    /**
     * @return string
     */
    public function getLon()
    {
        return $this->lon;
    }

    /**
     * @param string $lon
     */
    public function setLon($lon)
    {
        $this->lon = $lon;
    }

    /**
     * @return array
     */
    public function jsonSerialize()
    {
        return [
            'description' => $this->getDescription(),
            'type' => $this->getEmergencyType()->getName(),
            'skills' => $this->getSkills(),
            'created' => $this->getCreated(),
            'lat' => $this->getLat(),
            'lon' => $this->getLon(),
        ];
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
     * @param $latlng
     * @return $this
     */
    public function setLatLng($latlng)
    {
        $this->setLat($latlng['lat']);
        $this->setLon($latlng['lon']);
    }

    /**
     * @return array
     */
    public function getLatLng()
    {
        return array('lat'=>$this->getLat(),'lng'=>$this->getLon());
    }

}

