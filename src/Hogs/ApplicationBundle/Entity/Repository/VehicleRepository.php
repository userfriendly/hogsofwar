<?php

namespace Hogs\ApplicationBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Hogs\ApplicationBundle\Entity\Vehicle;

/**
 * Query Repository for Vehicle entity
 */
class VehicleRepository extends EntityRepository
{
    /**
     * Synchronises vehicle data in local database
     * with vehicle data retrieved from Wargaming.net
     *
     * @param stdClass $object
     *
     * @return \Hogs\ApplicationBundle\Entity\Vehicle
     */
    public function synchronise( $object )
    {
        $handle = trim( $object->id );
        $vehicle = $this->findOneByHandle( $handle );
        if ( !$vehicle )
        {
            $vehicle = new Vehicle();
            $vehicle->setHandle( $handle );
            $this->getEntityManager()->persist( $vehicle );
        }
        $vehicle->setContourUrl( trim( $object->contour_image ));
        $vehicle->setName      ( trim( $object->name ));
        $vehicle->setNation    ( trim( $object->nation ));
        $vehicle->setPremium   ( trim( $object->is_premium ) ? true : false );
        $vehicle->setTier      ( trim( $object->level ));
        return $vehicle;
    }
}
