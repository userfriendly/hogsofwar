<?php

namespace Hogs\ApplicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use WG\OpenIdUserBundle\Entity\User;
use Hogs\ApplicationBundle\Entity\PlayedVehicle;

/**
 * @ORM\Entity
 * @ORM\Table(name="hogs__member")
 */
class Member
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\OneToOne(targetEntity="WG\OpenIdUserBundle\Entity\User")
     */
    protected $user;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="PlayedVehicle", mappedBy="member")
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
     * @return \Hogs\ApplicationBundle\Entity\Member
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
     * Set user
     *
     * @param \WG\OpenIdUserBundle\Entity\User $user
     * @return \Hogs\ApplicationBundle\Entity\Member
     */
    public function setUser( User $user = null )
    {
        $this->user = $user;
        return $this;
    }

    /**
     * Get user
     *
     * @return \WG\OpenIdUserBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add playedVehicles
     *
     * @param \Hogs\ApplicationBundle\Entity\PlayedVehicle $playedVehicle
     * @return \Hogs\ApplicationBundle\Entity\Member
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