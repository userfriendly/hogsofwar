<?php

// call from shell with `php app/console hogs:check:usage`

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

class TankUsageCommand extends ContainerAwareCommand
{
    const PAUSE_BETWEEN_REQUESTS = 2;    // pause in seconds, we don't want to annoy WG too much do we...
    const WEEKS_TO_CHECK = 2;    // 336 hours is maximum => 2 weeks
    const URL_STATS = "http://dvstats.wargaming.net/userstats/2/stats/slice/?platform=android&server=eu&account_id=%%ACCOUNT_ID%%";

    protected $urlSuffix;

    public function configure()
    {
        $this->setName( 'hogs:check:usage' )
             ->setDescription( 'Checks how long players haven\'t been using their tanks.' );
        $this->urlSuffix = '&hours_ago=0';
        for ( $week = 1 ; $week < self::WEEKS_TO_CHECK ; $week++ )
        {
            $hours = 24 * $week;
            $this->urlSuffix .= '&hours_ago=' . $hours;
        }
    }

    public function execute( InputInterface $input, OutputInterface $output )
    {
        $em = $this->getContainer()->get( 'doctrine' )->getEntityManager();
        $playedVehicleRepo = $em->getRepository( 'HogsApplicationBundle:PlayedVehicle' );
        $pv = $playedVehicleRepo->find( 1 );
        $date = new \DateTime();
        $date->modify( '-5 days' );
        $pv->setUpdatedAt( $date );
        $em->flush();
        // TODO: find URL that works for past stats, the above doesn't...
    }

    protected function getData( $url )
    {
        $browser = new Browser();
        $json = $browser->get( $url )->getContent();
        return json_decode( $json );
    }
}
