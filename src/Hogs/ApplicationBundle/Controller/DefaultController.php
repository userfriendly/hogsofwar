<?php

namespace Hogs\ApplicationBundle\Controller;

// Base controller
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// Annotation classes
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     * @Template()
     */
    public function indexAction()
    {
        return array();
    }
}
