<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Doctrine\Common\Collections\ArrayCollection;
use ApiPlatform\Core\Annotation\ApiSubresource;
use ApiPlatform\Core\Annotation\ApiFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\OrderFilter;
use ApiPlatform\Core\Serializer\Filter\GroupFilter;
use Symfony\Component\Serializer\Annotation\Groups;
use ApiPlatform\Core\Serializer\Filter\PropertyFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\RangeFilter;
use ApiPlatform\Core\Bridge\Doctrine\Orm\Filter\DateFilter;
use ApiPlatform\Core\Annotation\ApiResource;

/**
 * @ORM\Table(name="product")
 * 
 *@ApiResource(
 *     collectionOperations={
 *         "get"={
 *              "method"="GET",
 *              "normalization_context"={"groups"={"list"}},
 *              "swagger_context"={"summary"="Permet de récupérer l'ensemble des ressources Product."}
 *          },
 *     },
 *     itemOperations={
 *         "get"={
 *              "method"="GET",
 *              "normalization_context"={"groups"={"show"}},
 *              "swagger_context"={"summary"="Permet de récupérer une ressource Product grâce à son id."}
 *          },
 *     }
 * )
 * 
 * @ApiFilter(SearchFilter::class, properties={"description": "partial", "brand": "exact", "properties": "partial"})
 * @ApiFilter(RangeFilter::class, properties={"price"})
 * @ApiFilter(DateFilter::class, properties={"dateAdd"})
 * 
 * @UniqueEntity(fields={"name"}, message="Ce produit existe déjà !") 
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product 
{
    /**
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     * @ORM\Id()
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=125)
     * @Assert\NotBlank
     * @Groups({"list", "show"})
     * 
     */
    private $name;

    /**
     * @ORM\Column(type="string", length=100)
     * @Assert\NotBlank
     * @Groups({"list", "show"})
     */
    private $brand;

    /**
     * @ORM\Column(type="text")
     * @Assert\NotBlank 
     * @Groups({"show"})
     */
    private $description;

    /**
     * @Assert\Date
     * @var string A "Y-m-d H:i:s" formatted value
     * @ORM\Column(type="datetime", nullable = true)
     * @Groups({"show"})
     */
    public $dateAdd;

    /**
     * @var string[] Describe the product
     *
     * @ORM\Column(type="json", nullable = true)
     * @Groups({"show"})
     */
    public $properties;

    /**
     * @ORM\Column(type="decimal", precision=65, scale=2)
     * @Assert\NotBlank
     * @Groups({"list", "show"})
     */
    private $price;


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getBrand(): ?string
    {
        return $this->brand;
    }

    public function setBrand(string $brand): self
    {
        $this->brand = $brand;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get describe the product
     *
     * @return  string[]
     */ 
    public function getProperties()
    {
        return $this->properties;
    }

    public function getDateAdd(): ?\DateTimeInterface
    {
        return $this->dateAdd;
    }

    public function setDateAdd(\DateTimeInterface $dateAdd): self
    {
        $this->dateAdd = $dateAdd;

        return $this;
    }

    /**
     * Set describe the product
     *
     * @param  string[]  $properties  Describe the product
     *
     * @return  self
     */ 
    public function setProperties(string $properties)
    {
        $this->properties = $properties;

        return $this;
    }

    public function getPrice()
    {
        return $this->price;
    }

    public function setPrice($price): self
    {
        $this->price = $price;

        return $this;
    }
}