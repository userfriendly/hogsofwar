<?php

namespace Hogs\ApplicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Hogs\ApplicationBundle\Entity\Member;
use Hogs\ApplicationBundle\Entity\Vehicle;

/**
 * @ORM\Entity
 * @ORM\Table(name="hogs__played_vehicle")
 */
class PlayedVehicle
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Member")
     */
    protected $member;

    /**
     * @ORM\ManyToOne(targetEntity="Vehicle")
     */
    protected $vehicle;

    /**
     * @ORM\Column(type="integer")
     */
    protected $battles;

    /**
     * @ORM\Column(type="integer")
     */
    protected $wins;

    /**
     * @ORM\Column(type="date", name="played_at")
     */
    protected $playedAt;

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
     * Set battles
     *
     * @param integer $battles
     * @return \Hogs\ApplicationBundle\Entity\PlayedVehicle
     */
    public function setBattles( $battles )
    {
        $this->battles = $battles;
        return $this;
    }

    /**
     * Get battles
     *
     * @return integer
     */
    public function getBattles()
    {
        return $this->battles;
    }

    /**
     * Set wins
     *
     * @param integer $wins
     * @return \Hogs\ApplicationBundle\Entity\PlayedVehicle
     */
    public function setWins( $wins )
    {
        $this->wins = $wins;
        return $this;
    }

    /**
     * Get wins
     *
     * @return integer
     */
    public function getWins()
    {
        return $this->wins;
    }

    /**
     * Set playedAt
     *
     * @param \DateTime $playedAt
     * @return \Hogs\ApplicationBundle\Entity\PlayedVehicle
     */
    public function setPlayedAt( $playedAt )
    {
        $this->playedAt = $playedAt;
        return $this;
    }

    /**
     * Get playedAt
     *
     * @return \DateTime
     */
    public function getPlayedAt()
    {
        return $this->playedAt;
    }

    /**
     * Set member
     *
     * @param \Hogs\ApplicationBundle\Entity\Member $member
     * @return \Hogs\ApplicationBundle\Entity\PlayedVehicle
     */
    public function setMember( Member $member = null )
    {
        $this->member = $member;
        return $this;
    }

    /**
     * Get member
     *
     * @return \Hogs\ApplicationBundle\Entity\Member
     */
    public function getMember()
    {
        return $this->member;
    }

    /**
     * Set vehicle
     *
     * @param \Hogs\ApplicationBundle\Entity\Vehicle $vehicle
     * @return \Hogs\ApplicationBundle\Entity\PlayedVehicle
     */
    public function setVehicle( Vehicle $vehicle = null )
    {
        $this->vehicle = $vehicle;
        return $this;
    }

    /**
     * Get vehicle
     *
     * @return \Hogs\ApplicationBundle\Entity\Vehicle
     */
    public function getVehicle()
    {
        return $this->vehicle;
    }
}