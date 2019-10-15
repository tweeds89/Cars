<?php

namespace CarBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Id;

/**
 * Class CarBrand
 * @package CarBundle\Entity
 * @ORM\Entity(repositoryClass="CarBundle\Repository\CarBrandRepository")
 * @ORM\Table(name="car_brands")
 */
class CarBrand
{
    /**
     * @Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @var string
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    protected $name = "";

    /**
     * @var CarModel[]|Collection $carModels
     * @ORM\OneToMany(targetEntity="CarBundle\Entity\CarModel", mappedBy="carBrand")
     */
    protected $carModels;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     * @return CarBrand
     */
    public function setId($id)
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return CarBrand
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return CarModel[]|Collection
     */
    public function getCarModels()
    {
        return $this->carModels;
    }

    /**
     * @param CarModel[]|Collection $carModels
     * @return CarBrand
     */
    public function setCarModels($carModels)
    {
        $this->carModels = $carModels;
        return $this;
    }
}
