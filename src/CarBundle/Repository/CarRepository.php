<?php

namespace CarBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class CarRepository
 * @package CarBundle\Repository
 */
class CarRepository extends EntityRepository
{
    /**
     * @param null $carBrand
     * @param null $carModel
     * @param null $productionYear
     * @param null $fuelType
     * @return array
     */
    public function findCars($carBrand = null, $carModel= null, $productionYear = null, $fuelType = null): array
    {
        $qb = $this->createQueryBuilder('cars');

        if (!is_null($carBrand)) {
            $qb->leftJoin('cars.carBrand', 'carBrand')
                ->where('carBrand.name LIKE :name')
                ->setParameter('name', $carBrand);
        }
        if (!is_null($carModel)) {
            $qb->andWhere('cars.model LIKE :model')
                ->setParameter('model', $carModel);
        }
        if (!is_null($productionYear)) {
            $qb->andWhere('cars.productionYear = :productionYear')
                ->setParameter('productionYear', $productionYear);
        }
        if (!is_null($fuelType)) {
            $qb->andWhere('cars.fuelType = :fuelType')
                ->setParameter('fuelType', $fuelType);
        }

        return $qb->getQuery()->getResult();
    }
}
