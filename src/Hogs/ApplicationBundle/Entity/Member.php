<?php

namespace Hogs\ApplicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
use WG\OpenIdUserBundle\Entity\User;
use Hogs\ApplicationBundle\Entity\PlayedVehicle;

/**
 * @ORM\Entity(repositoryClass="Hogs\ApplicationBundle\Entity\Repository\MemberRepository")
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
     * @ORM\Column(type="integer", name="account_id")
     */
    protected $accountId;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $active;

    /**
     * @ORM\Column(type="integer")
     */
    protected $battles;

    /**
     * @ORM\Column(type="integer")
     */
    protected $wins;

    /**
     * @ORM\Column(type="integer")
     */
    protected $kills;

    /**
     * @ORM\Column(type="integer")
     */
    protected $survivals;

    /**
     * @ORM\Column(type="integer", name="hits_percent")
     */
    protected $hitsPercent;

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
     * Set accountId
     *
     * @param integer $accountId
     * @return \Hogs\ApplicationBundle\Entity\Member
     */
    public function setAccountId( $accountId )
    {
        $this->accountId = $accountId;
        return $this;
    }

    /**
     * Get accountId
     *
     * @return integer
     */
    public function getAccountId()
    {
        return $this->accountId;
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
     * Set active
     *
     * @param boolean $active
     * @return \Hogs\ApplicationBundle\Entity\Member
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
     * Set battles
     *
     * @param integer $battles
     * @return \Hogs\ApplicationBundle\Entity\Member
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
     * @return \Hogs\ApplicationBundle\Entity\Member
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
     * Set kills
     *
     * @param integer $kills
     * @return \Hogs\ApplicationBundle\Entity\Member
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
     * @return \Hogs\ApplicationBundle\Entity\Member
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
     * @param integer $hitsPercent
     * @return \Hogs\ApplicationBundle\Entity\Member
     */
    public function setHitsPercent( $hitsPercent )
    {
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
     * Set lastBattleAt
     *
     * @param \DateTime $lastBattleAt
     * @return \Hogs\ApplicationBundle\Entity\Member
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
     * @return \Hogs\ApplicationBundle\Entity\Member
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

    /**
     * Get a specific played vehicle
     *
     * @param string $handle
     *
     * @return \Hogs\ApplicationBundle\Entity\PlayedVehicle
     */
    public function getPlayedVehicle( $handle )
    {
        foreach ( $this->playedVehicles as $playedVehicle )
        {
            if ( $playedVehicle->getVehicle()->getHandle() == $handle ) return $playedVehicle;
        }
    }
}