<?php

namespace CarBundle\Models;

/**
 * Class CarsFilterModel
 * @package CarBundle\Models
 */
class CarsFilterModel
{
    /**
     * @var string $carBrand
     */
    protected $carBrand;

    /**
     * @var string $carModel
     */
    protected $carModel;

    /**
     * @var int $productionYear
     */
    protected $productionYear;

    /**
     * @var string $fuelType
     */
    protected $fuelType;

    /**
     * @return string
     */
    public function getCarBrand(): ?string
    {
        return $this->carBrand;
    }

    /**
     * @param string $carBrand
     * @return CarsFilterModel
     */
    public function setCarBrand(string $carBrand): CarsFilterModel
    {
        $this->carBrand = $carBrand;
        return $this;
    }

    /**
     * @return string
     */
    public function getCarModel(): ?string
    {
        return $this->carModel;
    }

    /**
     * @param string $carModel
     * @return CarsFilterModel
     */
    public function setCarModel(string $carModel): CarsFilterModel
    {
        $this->carModel = $carModel;
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
     * @return CarsFilterModel
     */
    public function setProductionYear(int $productionYear): CarsFilterModel
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
     * @return CarsFilterModel
     */
    public function setFuelType(string $fuelType): CarsFilterModel
    {
        $this->fuelType = $fuelType;
        return $this;
    }
}
