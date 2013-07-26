<?php

namespace Hogs\ApplicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Hogs\ApplicationBundle\Entity\PlayedVehicle;

/**
 * @ORM\Entity(repositoryClass="Hogs\ApplicationBundle\Entity\Repository\VehicleRepository")
 * @ORM\Table(name="wot__vehicle")
 */
class Vehicle
{
	/**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="string", unique=true)
     */
    protected $handle;

    /**
     * @ORM\Column(type="integer")
     */
    protected $tier;

    /**
     * @ORM\Column(type="integer")
     */
    protected $country;

    /**
     * @ORM\Column(type="integer")
     */
    protected $type;

    /**
     * @ORM\Column(type="string", name="contour_url", nullable=true)
     */
    protected $contourUrl;

    /**
     * @ORM\Column(type="string", name="image_url", nullable=true)
     */
    protected $imageUrl;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $premium;

    /**
     * @ORM\OneToMany(targetEntity="PlayedVehicle", mappedBy="vehicle")
     */
    protected $playedVehicles;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->playedVehicles = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return \Hogs\ApplicationBundle\Entity\Vehicle
     */
    public function setName( $name )
    {
        $this->name = $name;
        return $this;
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
     * Set handle
     *
     * @param string $handle
     * @return \Hogs\ApplicationBundle\Entity\Vehicle
     */
    public function setHandle( $handle )
    {
        $this->handle = $handle;
        return $this;
    }

    /**
     * Get handle
     *
     * @return string
     */
    public function getHandle()
    {
        return $this->handle;
    }

    /**
     * Set tier
     *
     * @param integer $tier
     * @return \Hogs\ApplicationBundle\Entity\Vehicle
     */
    public function setTier( $tier )
    {
        $this->tier = $tier;
        return $this;
    }

    /**
     * Get tier
     *
     * @return integer
     */
    public function getTier()
    {
        return $this->tier;
    }

    /**
     * Set country
     *
     * @param integer $country
     * @return \Hogs\ApplicationBundle\Entity\Vehicle
     */
    public function setCountry( $country )
    {
        $this->country = $country;
        return $this;
    }

    /**
     * Get country
     *
     * @return integer
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set type
     *
     * @param integer $type
     * @return \Hogs\ApplicationBundle\Entity\Vehicle
     */
    public function setType( $type )
    {
        $this->type = $type;
        return $this;
    }

    /**
     * Get type
     *
     * @return integer
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set contourUrl
     *
     * @param string $contourUrl
     * @return \Hogs\ApplicationBundle\Entity\Vehicle
     */
    public function setContourUrl( $contourUrl )
    {
        $this->contourUrl = $contourUrl;
        return $this;
    }

    /**
     * Get contourUrl
     *
     * @return string
     */
    public function getContourUrl()
    {
        return $this->contourUrl;
    }

    /**
     * Set imageUrl
     *
     * @param string $imageUrl
     * @return \Hogs\ApplicationBundle\Entity\Vehicle
     */
    public function setImageUrl( $imageUrl )
    {
        $this->imageUrl = $imageUrl;
        return $this;
    }

    /**
     * Get imageUrl
     *
     * @return string
     */
    public function getImageUrl()
    {
        return $this->imageUrl;
    }

    /**
     * Set premium
     *
     * @param boolean $premium
     * @return \Hogs\ApplicationBundle\Entity\Vehicle
     */
    public function setPremium( $premium )
    {
        $this->premium = $premium;
        return $this;
    }

    /**
     * Get premium
     *
     * @return boolean
     */
    public function getPremium()
    {
        return $this->premium;
    }

    /**
     * Add playedVehicles
     *
     * @param \Hogs\ApplicationBundle\Entity\PlayedVehicle $playedVehicle
     * @return \Hogs\ApplicationBundle\Entity\Vehicle
     */
    public function addPlayedVehicle( PlayedVehicle $playedVehicle )
    {
        $this->playedVehicles[] = $playedVehicle;
        return $this;
    }

    /**
     * Remove playedVehicles
     *
     * @param \Hogs\ApplicationBundle\Entity\PlayedVehicle $playedVehicle
     */
    public function removePlayedVehicle( PlayedVehicle $playedVehicle )
    {
        $this->playedVehicles->removeElement( $playedVehicle );
    }

    /**
     * Get playedVehicles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPlayedVehicles()
    {
        return $this->playedVehicles;
    }
}