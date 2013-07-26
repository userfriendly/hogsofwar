<?php

// call from shell with `php app/console hogs:test`

namespace Hogs\ApplicationBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Buzz\Browser;
use Hogs\ApplicationBundle\Entity\Vehicle;
use Hogs\ApplicationBundle\Entity\Member;
use Hogs\ApplicationBundle\Entity\PlayedVehicle;

class TestCommand extends ContainerAwareCommand
{
    const URL_VEHICLE_JSON = "https://raw.github.com/Phalynx/WoT-Dossier-Cache-to-JSON/master/tanks.json";
    const URL_DOSSIER_TO_JSON = "http://wot-dossier.appspot.com/service/dossier-to-json";

    public function configure()
    {
        $this->setName( 'hogs:test' )
             ->setDescription( 'Test command.' );
    }

    public function execute( InputInterface $input, OutputInterface $output )
    {
        $em = $this->getContainer()->get( 'doctrine' )->getEntityManager();
        $vehicleRepo = $em->getRepository( 'HogsApplicationBundle:Vehicle' );
        $memberRepo = $em->getRepository( 'HogsApplicationBundle:Member' );
    	// Get "logged on" member instance
    	$member = $memberRepo->findOneByName( "userfriendly" );
    	// Get Phalynx's vehicle file
		$phalynxData = $this->curlRequest( self::URL_VEHICLE_JSON );
    	// Post "uploaded" dossier file to wot-dossier.appspot.com and retrieve JSON representation of it
    	$data = $this->curlRequest( self::URL_DOSSIER_TO_JSON, "/home/mo/dossier.dat" );
    	foreach ( $data->tanks as $object )
    	{
            $tankId = trim( $object->id );
            $countryId = trim( $object->country );
            $handle = $this->getVehicleHandleFromPhalynxData( $phalynxData, $countryId, $tankId );
            $playedVehicle = $member->getPlayedVehicle( $handle );
            if ( !$playedVehicle )
            {
                $vehicle = $vehicleRepo->findOneByHandle( $handle );
                $playedVehicle = new PlayedVehicle();
                $playedVehicle->setMember( $member );
                $playedVehicle->setVehicle( $vehicle );
                $em->persist( $playedVehicle );
            }
            $lastPlayed = new \DateTime();
            $lastPlayed->setTimestamp( trim( $object->last_time_played ));
            if ( null === $playedVehicle->getLastBattleAt() || $lastPlayed > $playedVehicle->getLastBattleAt() )
            {
                $playedVehicle->setActive( true );
                $playedVehicle->setLastBattleAt( $lastPlayed );
                $playedVehicle->setBattles( trim( $object->amounts->battles ));
                $playedVehicle->setWins( trim( $object->amounts->victories ));
                $playedVehicle->setSpots( trim( $object->amounts->spotted ));
                $playedVehicle->setDamageDealt( trim( $object->amounts->damage_dealt ));
                $playedVehicle->setKills( trim( $object->amounts->frags ));
                $playedVehicle->setSurvivals( trim( $object->amounts->survived ));
                $playedVehicle->setHitsPercent( trim( $object->amounts->hits ), trim( $object->amounts->shots ));
            }
    	}
    	$em->flush();
    }

    protected function curlRequest( $url, $filename = null)
    {
    	$command = "curl";
    	if ( null !== $filename ) $command .= " --data-binary @" . $filename;
    	$command .= " " . $url;
    	$json = shell_exec( $command );
    	return json_decode( $json );
    }

    protected function getVehicleHandleFromPhalynxData( $data, $countryId, $tankId )
    {
    	foreach ( $data as $tank )
    	{
    		if ( $tank->tankid == $tankId && $tank->countryid == $countryId )
    		{
    			return $tank->icon_orig;
    		}
    	}
    }
}
