<?php

namespace Hogs\ApplicationBundle\Twig\Extension;

use Twig_Extension;
use Twig_Function_Method;

class ApplicationExtension extends Twig_Extension
{
    public function getName()
    {
        return 'application_extension';
    }

    public function getFunctions()
    {
        return array(
            'foo' => new \Twig_Function_Method( $this, 'foo' ),
        );
    }

    /**
     * Returns foo
     *
     * @return string
     */
    public function foo()
    {
        return 'foo';
    }
}
