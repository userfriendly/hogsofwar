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
     * @ORM\Column(type="integer")
     */
    protected $battles;

    /**
     * @ORM\Column(type="integer")
     */
    protected $wins;

    /**
     * @ORM\Column(name="updated_at",type="datetime")
     * @Gedmo\Timestampable(on="update")
     */
    protected $updatedAt;

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