<?php

namespace CarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Id;

/**
 * Class Car
 * @package CarBundle\Entity
 * @ORM\Entity(repositoryClass="CarBundle\Repository\CarRepository")
 * @ORM\Table(name="cars")
 */
class Car
{
    /**
     * @Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var CarBrand $carBrand
     * @ORM\ManyToOne(targetEntity="CarBundle\Entity\CarBrand", inversedBy="cars")
     * @ORM\JoinColumn(name="car_brand_id", nullable=false)
     */
    protected $carBrand;

    /**
     * @var string $model
     * @ORM\Column(name="model", type="string", length=255, nullable=false)
     */
    protected $model;

    /**
     * @var \int $productionYear
     * @ORM\Column(name="production_year", type="integer", nullable=false)
     */
    protected $productionYear;

    /**
     * @var string $fuelType
     * @ORM\Column(name="fuel_type", type="string", length=255, nullable=false)
     */
    protected $fuelType;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return Car
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return CarBrand
     */
    public function getCarBrand()
    {
        return $this->carBrand;
    }

    /**
     * @param CarBrand $carBrand
     * @return Car
     */
    public function setCarBrand($carBrand)
    {
        $this->carBrand = $carBrand;
        return $this;
    }

    /**
     * @return string
     */
    public function getModel()
    {
        return $this->model;
    }

    /**
     * @param string $model
     * @return Car
     */
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @return int
     */
    public function getProductionYear(): ?int
    {
        return $this->productionYear;
    }

    /**
     * @param int $productionYear
     * @return Car
     */
    public function setProductionYear(int $productionYear): Car
    {
        $this->productionYear = $productionYear;
        return $this;
    }

    /**
     * @return string
     */
    public function getFuelType(): ?string
    {
        return $this->fuelType;
    }

    /**
     * @param string $fuelType
     * @return Car
     */
    public function setFuelType(string $fuelType): Car
    {
        $this->fuelType = $fuelType;
        return $this;
    }
}
