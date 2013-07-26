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
        return $this->render( 'HogsApplicationBundle:Default:vehicles.html.twig', array(
        ));
    }
}
