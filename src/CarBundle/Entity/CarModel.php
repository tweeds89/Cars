<?php

namespace CarBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Id;

/**
 * Class CarModel
 * @package CarBundle\Entity
 * @ORM\Entity(repositoryClass="CarBundle\Repository\CarModelRepository")
 * @ORM\Table(name="car_models")
 */
class CarModel
{
    /**
     * @Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var CarBrand $carBrand
     * @ORM\ManyToOne(targetEntity="CarBundle\Entity\CarBrand", inversedBy="carModels")
     * @ORM\JoinColumn(name="car_brand_id", nullable=false)
     */
    protected $carBrand;

    /**
     * @var string $model
     * @ORM\Column(name="model", type="string", length=255, nullable=false)
     */
    protected $model;

    /**
     * @var \DateTime $productionDate
     * @ORM\Column(name="production_date", type="date", nullable=false)
     */
    protected $productionDate;

    /**
     * @var string $engineType
     * @ORM\Column(name="engine_type", type="string", length=255, nullable=false)
     */
    protected $engineType;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return CarModel
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
     * @return CarModel
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
     * @return CarModel
     */
    public function setModel($model)
    {
        $this->model = $model;
        return $this;
    }

    /**
     * @return \DateTime
     */
    public function getProductionDate()
    {
        return $this->productionDate;
    }

    /**
     * @param \DateTime $productionDate
     * @return CarModel
     */
    public function setProductionDate($productionDate)
    {
        $this->productionDate = $productionDate;
        return $this;
    }

    /**
     * @return string
     */
    public function getEngineType()
    {
        return $this->engineType;
    }

    /**
     * @param string $engineType
     * @return CarModel
     */
    public function setEngineType($engineType)
    {
        $this->engineType = $engineType;
        return $this;
    }
}
