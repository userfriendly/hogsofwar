<?php

// call from shell with `php app/console hogs:update:vehicles`

namespace Hogs\ApplicationBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Buzz\Browser;
use Hogs\ApplicationBundle\Entity\Vehicle;

class UpdateVehiclesCommand extends ContainerAwareCommand
{
    const URL_VEHICLES = "http://api.worldoftanks.eu/encyclopedia/vehicles/api/1.0/?source_token=WG-WoT_Assistant-1.3.2";

    public function configure()
    {
        $this->setName( 'hogs:update:vehicles' )
             ->setDescription( 'Synchronises vehicle data with Wargaming.net\'s API server.' );
    }

    public function execute( InputInterface $input, OutputInterface $output )
    {
        $em = $this->getContainer()->get( 'doctrine' )->getEntityManager();
        $repo = $em->getRepository( 'HogsApplicationBundle:Vehicle' );
        // Retrieve current vehicle data
        $output->writeln( '<comment>Retrieving data from Wargaming.net\'s API server...</comment>' );
        $browser = new Browser();
        $json = $browser->get( self::URL_VEHICLES )->getContent();
        $data = json_decode( $json );
        // Loop through data and update database
        $output->writeln( '<comment>Updating local database...</comment>' );
        foreach ( $data->data->items as $object )
        {
            $handle = trim( $object->id );
            $vehicle = $repo->findOneByHandle( $handle );
            if ( !$vehicle )
            {
                $vehicle = new Vehicle();
                $vehicle->setHandle( $handle );
                $em->persist( $vehicle );
            }
            $vehicle->setContourUrl( trim( $object->contour_image ));
            $vehicle->setName( trim( $object->name ));
            $vehicle->setNation( trim( $object->nation ));
            $vehicle->setPremium( trim( $object->is_premium ) ? true : false );
            $vehicle->setTier( trim( $object->level ));
        }
        $em->flush();
        $output->writeln( '<info>Vehicle data synchronised.</info>' );
    }
}
