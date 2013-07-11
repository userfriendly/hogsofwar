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
        $url = 'http://api.worldoftanks.eu/encyclopedia/vehicles/api/1.0/?source_token=WG-WoT_Assistant-1.3.2';
        $browser = new Browser();
        $json = $browser->get( $url )->getContent();
        $data = json_decode( $json );
        #echo "<pre>" . print_r( $data->data->items, true ) . "</pre>"; die(); exit;
        return $this->render( 'HogsApplicationBundle:Default:vehicles.html.twig', array(
            'vehicles' => $data->data->items,
            'json' => $json,
        ));
    }
}
