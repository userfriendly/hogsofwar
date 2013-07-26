<?php

// call from shell with `php app/console hogs:update`

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

class UpdateCommand extends ContainerAwareCommand
{
    const PAUSE_BETWEEN_REQUESTS = 2;    // pause in seconds, we don't want to annoy WG too much do we...
    const URL_VEHICLES = "http://api.worldoftanks.eu/encyclopedia/vehicles/api/1.0/?source_token=WG-WoT_Assistant-1.3.2";
    const URL_CLAN = "http://api.worldoftanks.eu/uc/clans/%%CLAN_ID%%/api/1.1/?source_token=WG-WoT_Assistant-1.3.2";
    const URL_PLAYER = "http://api.worldoftanks.eu/uc/accounts/%%ACCOUNT_ID%%/api/1.8/?source_token=WG-WoT_Assistant-1.3.2";
    const URL_PLAYER_ALT = "http://dvstats.wargaming.net/userstats/2/stats/slice/?platform=android&server=eu&account_id=%%ACCOUNT_ID%%&hours_ago=0";

    public function configure()
    {
        $this->setName( 'hogs:update' )
             ->setDescription( 'Synchronises local data with World of Tanks.' );
    }

    public function execute( InputInterface $input, OutputInterface $output )
    {
        $em = $this->getContainer()->get( 'doctrine' )->getEntityManager();
        //////////////////
        // VEHICLE DATA //
        //////////////////
        $output->writeln( '<comment>Retrieving vehicle data from api.worldoftanks.eu</comment>' );
        $vehicleData = $this->getData( self::URL_VEHICLES );
        $output->writeln( '<comment>Updating local database...</comment>' );
        $vehicleRepo = $em->getRepository( 'HogsApplicationBundle:Vehicle' );
        foreach ( $vehicleData->data->items as $object ) $vehicleRepo->synchronise( $object );
        $em->flush();
        $output->writeln( '<info>Vehicle data synchronised.</info>' );
        sleep( self::PAUSE_BETWEEN_REQUESTS );
        ///////////////
        // CLAN DATA //
        ///////////////
        $output->writeln( '<comment>Retrieving member list from api.worldoftanks.eu</comment>' );
        $url = str_replace( "%%CLAN_ID%%", $this->getContainer()->getParameter( 'clan_id' ), self::URL_CLAN );
        $clanData = $this->getData( $url );
        $output->writeln( '<comment>Updating local database...</comment>' );
        $memberRepo = $em->getRepository( 'HogsApplicationBundle:Member' );
        $accountIds = array();
//        /* dev */ $cnt = 0;
        foreach ( $clanData->data->members as $member )
        {
//             /* dev */ $cnt++;
//             /* dev */ if ( $cnt > 2 ) break;    // for testing purposes only query the first 2 players
            sleep( self::PAUSE_BETWEEN_REQUESTS );
            /////////////////
            // MEMBER DATA //
            /////////////////
            $accountId = trim( $member->account_id );
            if ( !$accountId ) throw new \Exception( "No such field in data: account_id" );
            $accountIds[] = $accountId;
            $accountName = trim( $member->account_name );
            if ( !$accountName ) throw new \Exception( "No such field in data: account_name" );
            if ( $memberRepo->needsUpdate( $accountId ))
            {
                $output->writeln( '<comment>Querying api.worldoftanks.eu for player ' . $accountName . '</comment>' );
                $url = str_replace( "%%ACCOUNT_ID%%", $accountId, self::URL_PLAYER );
                $memberRepo->synchronise( $accountId, $this->getData( $url )->data );
            }
            else $output->writeln( '<comment>Player ' . $accountName . '\'s data is recent enough</comment>' );
        }
        $memberRepo->cullTheHerd( $accountIds );
        $em->flush();
        $output->writeln( '<info>Member data synchronised.</info>' );
    }

    protected function getData( $url )
    {
        $browser = new Browser();
        $json = $browser->get( $url )->getContent();
        return json_decode( $json );
    }
}
