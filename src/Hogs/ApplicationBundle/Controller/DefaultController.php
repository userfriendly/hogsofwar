<?php

namespace Hogs\ApplicationBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Buzz\Browser;

class DefaultController extends Controller
{
    /**
     * Homepage
     */
    public function indexAction()
    {
        return $this->render( 'HogsApplicationBundle:Default:index.html.twig', array(
        ));
    }

    /**
     * Vehicle roster
     */
    public function vehiclesAction()
    {
        $url = 'http://dvstats.wargaming.net/userstats/2/stats/slice/?platform=android&server=eu&account_id=500487083&hours_ago=24';
        $browser = new Browser();
        $json = $browser->get( $url )->getContent();
        $data = json_decode( $json );
        echo "<pre>" . print_r( $data, true ) . "</pre>"; die(); exit;
        return $this->render( 'HogsApplicationBundle:Default:vehicles.html.twig', array(
            'vehicles' => $data->data->items,
            'json' => $json,
        ));
    }
}
