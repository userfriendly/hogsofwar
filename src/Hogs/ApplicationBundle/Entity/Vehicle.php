<?php

namespace Hogs\ApplicationBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="vehicle")
 */
class Vehicle
{
    const NATION_CHINA   = "china";
    const NATION_FRANCE  = "france";
    const NATION_GERMANY = "germany";
    const NATION_UK      = "uk";
    const NATION_USA     = "usa";
    const NATION_USSR    = "ussr";

    const TYPE_LIGHT    = "lightTank";
    const TYPE_MEDIUM   = "mediumTank";
    const TYPE_HEAVY    = "heavyTank";
    const TYPE_TD       = "AT-SPG";
    const TYPE_ARTY     = "SPG";

    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string")
     */
    protected $name;

    /**
     * @ORM\Column(type="string")
     */
    protected $handle;

    /**
     * @ORM\Column(type="integer")
     */
    protected $tier;

    /**
     * @ORM\Column(type="string", name="contour_url")
     */
    protected $contourUrl;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $premium;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->premium = false;
    }
}