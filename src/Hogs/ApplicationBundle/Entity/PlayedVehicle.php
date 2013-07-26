<?php

namespace Hogs\ApplicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Gedmo\Mapping\Annotation as Gedmo;
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
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $battles;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $wins;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $spots;

    /**
     * @ORM\Column(type="integer", nullable=true, name="damage_dealt")
     */
    protected $damageDealt;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $kills;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $survivals;

    /**
     * @ORM\Column(type="integer", nullable=true, name="hits_percent")
     */
    protected $hitsPercent;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $active;

    /**
     * @ORM\Column(type="datetime", nullable=true, name="last_battle_at")
     */
    protected $lastBattleAt;

    /**
     * @ORM\Column(type="datetime", name="updated_at")
     * @Gedmo\Timestampable(on="update")
     */
    protected $updatedAt;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->active = true;
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
     * Set spots
     *
     * @param integer $spots
     * @return \Hogs\ApplicationBundle\Entity\PlayedVehicle
     */
    public function setSpots( $spots )
    {
        $this->spots = $spots;
        return $this;
    }

    /**
     * Get spots
     *
     * @return integer
     */
    public function getSpots()
    {
        return $this->spots;
    }

    /**
     * Set damageDealt
     *
     * @param integer $damageDealt
     * @return \Hogs\ApplicationBundle\Entity\PlayedVehicle
     */
    public function setDamageDealt( $damageDealt )
    {
        $this->damageDealt = $damageDealt;
        return $this;
    }

    /**
     * Get damageDealt
     *
     * @return integer
     */
    public function getDamageDealt()
    {
        return $this->damageDealt;
    }

    /**
     * Set kills
     *
     * @param integer $kills
     * @return \Hogs\ApplicationBundle\Entity\PlayedVehicle
     */
    public function setKills( $kills )
    {
        $this->kills = $kills;
        return $this;
    }

    /**
     * Get kills
     *
     * @return integer
     */
    public function getKills()
    {
        return $this->kills;
    }

    /**
     * Set survivals
     *
     * @param integer $survivals
     * @return \Hogs\ApplicationBundle\Entity\PlayedVehicle
     */
    public function setSurvivals( $survivals )
    {
        $this->survivals = $survivals;
        return $this;
    }

    /**
     * Get survivals
     *
     * @return integer
     */
    public function getSurvivals()
    {
        return $this->survivals;
    }

    /**
     * Set hitsPercent
     *
     * @param integer $hits
     * @param integer $shots
     * @return \Hogs\ApplicationBundle\Entity\PlayedVehicle
     */
    public function setHitsPercent( $hits, $shots )
    {
    	$hitsPercent = $shots ? ( 100 / $shots ) * $hits : 0;
        $this->hitsPercent = $hitsPercent;
        return $this;
    }

    /**
     * Get hitsPercent
     *
     * @return integer
     */
    public function getHitsPercent()
    {
        return $this->hitsPercent;
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return \Hogs\ApplicationBundle\Entity\PlayedVehicle
     */
    public function setActive( $active )
    {
        $this->active = $active;
        return $this;
    }

    /**
     * Get active
     *
     * @return boolean
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set lastBattleAt
     *
     * @param \DateTime $lastBattleAt
     * @return \Hogs\ApplicationBundle\Entity\PlayedVehicle
     */
    public function setLastBattleAt( $lastBattleAt )
    {
        $this->lastBattleAt = $lastBattleAt;
        return $this;
    }

    /**
     * Get lastBattleAt
     *
     * @return \DateTime
     */
    public function getLastBattleAt()
    {
        return $this->lastBattleAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     * @return \Hogs\ApplicationBundle\Entity\PlayedVehicle
     */
    public function setUpdatedAt( $updatedAt )
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
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