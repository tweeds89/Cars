<?php

namespace CarBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Internal\Hydration\IterableResult;

/**
 * Class CarRepository
 * @package CarBundle\Repository
 */
class CarRepository extends EntityRepository
{
    /**
     * @return IterableResult
     */
    public function findCars(): IterableResult
    {
        return $this->createQueryBuilder('cars')
            ->select()
            ->getQuery()
            ->iterate();
    }
}
