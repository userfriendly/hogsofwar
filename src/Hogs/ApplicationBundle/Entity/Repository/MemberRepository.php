<?php

namespace Hogs\ApplicationBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Hogs\ApplicationBundle\Entity\Member;
use Hogs\ApplicationBundle\Entity\Vehicle;
use Hogs\ApplicationBundle\Entity\PlayedVehicle;

/**
 * Query Repository for Vehicle entity
 */
class MemberRepository extends EntityRepository
{
    /**
     * Synchronises player data in local database with player data retrieved from Wargaming.net
     *
     * @param stdClass $object
     *
     * @return \Hogs\ApplicationBundle\Entity\Member
     */
    public function synchronise( $accountId, $object )
    {
        $em = $this->getEntityManager();
        // Synchronise player data
        $member = $this->findOneByAccountId( $accountId );
        if ( !$member )
        {
            $member = new Member();
            $member->setAccountId( $accountId );
            $em->persist( $member );
        }
        $member->setActive     ( true );
        $member->setName       ( trim( $object->name ));
        $member->setBattles    ( trim( $object->summary->battles_count ));
        $member->setWins       ( trim( $object->summary->wins ));
        $member->setDeaths     ( $member->getBattles() - trim( $object->summary->survived_battles ));
        $member->setKills      ( trim( $object->battles->frags ));
        $member->setDamageDealt( trim( $object->battles->damage_dealt ));
        $member->setHitsPercent( trim( $object->battles->hits_percents ));
        $member->setSpots      ( trim( $object->battles->spotted ));
        // Synchronise played vehicle data
        $vehicleRepo = $em->getRepository( 'HogsApplicationBundle:Vehicle' );
        foreach ( $object->vehicles as $playedVehicleData )
        {
            $handle = trim( $playedVehicleData->name );
            $playedVehicle = $member->getPlayedVehicle( $handle );
            if ( !$playedVehicle )
            {
                $vehicle = $vehicleRepo->findOneByHandle( $handle );
                if ( !$vehicle->getImageUrl() ) $vehicle->setImageUrl( trim( $playedVehicleData->image_url ));
                $playedVehicle = new PlayedVehicle();
                $playedVehicle->setMember( $member );
                $playedVehicle->setVehicle( $vehicle );
                $em->persist( $playedVehicle );
            }
            $battles = trim( $playedVehicleData->battle_count );
            $wins = trim( $playedVehicleData->win_count );
            if ( $playedVehicle->getBattles() < $battles )
            {
                $playedVehicle->setBattles( $battles );
                $playedVehicle->setWins( $wins );
            }

        }
        return $member;
    }

    /**
     * Checks if player data needs updating or not
     *
     * @param integer $accountId
     *
     * @return boolean
     */
    public function needsUpdate( $accountId )
    {
        $member = $this->findOneByAccountId( $accountId );
        if ( !$member ) return true;
        $now = new \DateTime();
        $updateTime = $member->getUpdatedAt()->modify( '+23 hours' );
        return $updateTime < $now;
    }

    /**
     * Disables players that have left the clan, takes array of active account IDs
     *
     * @param array $accountIds
     */
    public function cullTheHerd( $accountIds )
    {
        $qb = $this->createQueryBuilder( 'm' );
        $fools = $qb->where( $qb->expr()->notIn( 'm.accountId', $accountIds ))
                    ->getQuery()->getResult();
        foreach ( $fools as $dumbAss ) $dumbAss->setActive( false );
    }
}
