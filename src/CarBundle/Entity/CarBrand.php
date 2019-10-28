<?php

namespace CarBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Id;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Class CarBrand
 * @package CarBundle\Entity
 * @ORM\Entity(repositoryClass="CarBundle\Repository\CarBrandRepository")
 * @ORM\Table(name="car_brands")
 * @UniqueEntity("name", message="Podana marka już istnieje")
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
     * @ORM\Column(name="name", type="string", length=255, unique=true, nullable=false)
     */
    protected $name;

    /**
     * @var Car[]|Collection $carModels
     * @ORM\OneToMany(targetEntity="CarBundle\Entity\Car", mappedBy="carBrand")
     */
    protected $cars;

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
    public function getName(): ?string
    {
        return $this->name;
    }

    /**
     * @param string $name
     * @return CarBrand
     */
    public function setName(string $name): CarBrand
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return Car[]|Collection
     */
    public function getCars()
    {
        return $this->cars;
    }

    /**
     * @param Car[]|Collection $cars
     * @return CarBrand
     */
    public function setCars($cars)
    {
        $this->cars = $cars;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName();
    }
}
