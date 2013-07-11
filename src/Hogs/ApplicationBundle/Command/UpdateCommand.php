<?php

// call from shell with
// php app/console hogs:update

namespace Hogs\ApplicationBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Buzz\Browser;

class UpdateCommand extends ContainerAwareCommand
{
    public function configure()
    {
        $this->setName( 'hogs:update' )
             ->setDescription( 'Synchronises database with data from Wargaming.net\'s API server.' );
    }

    public function execute( InputInterface $input, OutputInterface $output )
    {
        $output->writeln( '<comment>Start executing command...</comment>' );
        // Get Entity Manager:
        #$em = $this->getContainer()->get( 'doctrine' )->getEntityManager();
        $url = 'http://api.worldoftanks.eu/encyclopedia/vehicles/api/1.0/?source_token=WG-WoT_Assistant-1.3.2';
        $browser = new Browser();
        $json = $browser->get( $url )->getContent();
        $data = json_decode( $json );
        echo print_r( $data->data->items, true );
        // ...
        $output->writeln( '<info>Command finished executing.</info>' );
    }
}
