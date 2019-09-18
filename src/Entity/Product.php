<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ProductRepository")
 */
class Product
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=100)
     */
    private $productName;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $manufacturer;

    /**
     * @ORM\Column(type="decimal", precision=25, scale=2)
     */
    private $price;

    /**
     * @ORM\Column(type="boolean")
     */
    private $discontinued;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $quantityInStock;

    private $quantity;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\QuoteLineItem", mappedBy="product")
     */
    private $quoteLineItems;

    /**
     * @return ArrayCollection
     */
    public function getQuantity(): ArrayCollection {
        return $this->quantity;
    }

    /**
     * @param ArrayCollection $quantity
     */
    public function setQuantity(ArrayCollection $quantity): void {
        $this->quantity = $quantity;
    }

    public function __construct()
    {
        $this->quantity = new ArrayCollection();
        $this->quoteLineItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getProductName(): ?string
    {
        return $this->productName;
    }

    public function setProductName(string $productName): self
    {
        $this->productName = $productName;

        return $this;
    }

    public function getManufacturer(): ?string
    {
        return $this->manufacturer;
    }

    public function setManufacturer(?string $manufacturer): self
    {
        $this->manufacturer = $manufacturer;

        return $this;
    }

    public function getPrice(): ?string
    {
        return $this->price;
    }

    public function setPrice(string $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDiscontinued(): ?bool
    {
        return $this->discontinued;
    }

    public function setDiscontinued(bool $discontinued): self
    {
        $this->discontinued = $discontinued;

        return $this;
    }

    public function getQuantityInStock(): ?int
    {
        return $this->quantityInStock;
    }

    public function setQuantityInStock(?int $quantityInStock): self
    {
        $this->quantityInStock = $quantityInStock;

        return $this;
    }

    /**
     * @return Collection|QuoteLineItem[]
     */
    public function getQuoteLineItems(): Collection
    {
        return $this->quoteLineItems;
    }

    public function __toString() {
        return $this->getProductName();
    }
}
