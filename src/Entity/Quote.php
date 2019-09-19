<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\QuoteRepository")
 */
class Quote
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Contact", inversedBy="quotes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $client;

    /**
     * @ORM\Column(type="date")
     */
    private $validUntil;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $subject;

    /**
     * @ORM\Column(type="string", length=120, nullable=true)
     */
    private $status;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="decimal", precision=25, scale=2)
     */
    private $subtotal;

    /**
     * @ORM\Column(type="decimal", precision=25, scale=2)
     */
    private $adjustment;

    /**
     * @ORM\Column(type="decimal", precision=25, scale=2)
     */
    private $total;

    /**
     * @Assert\Valid()
     * @ORM\OneToMany(targetEntity="App\Entity\QuoteLineItem", mappedBy="quote", orphanRemoval=true, cascade={"all"})
     */
    private $quoteLineItems;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\User", inversedBy="quotes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $owner;

    public function __construct()
    {
        $this->quoteLineItems = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getClient(): ?Contact
    {
        return $this->client;
    }

    public function setClient(?Contact $contact): self
    {
        $this->client = $contact;

        return $this;
    }

    public function getValidUntil(): ?\DateTimeInterface
    {
        return $this->validUntil;
    }

    public function setValidUntil(\DateTimeInterface $validUntil): self
    {
        $this->validUntil = $validUntil;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }

    public function getStatus(): ?string
    {
        return $this->status;
    }

    public function setStatus(?string $status): self
    {
        $this->status = $status;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSubtotal(): ?string
    {
        return $this->subtotal;
    }

    public function setSubtotal(string $subtotal): self
    {
        $this->subtotal = $subtotal;

        return $this;
    }

    public function getAdjustment(): ?string
    {
        return $this->adjustment;
    }

    public function setAdjustment(string $adjustment): self
    {
        $this->adjustment = $adjustment;

        return $this;
    }

    public function getTotal(): ?string
    {
        return $this->total;
    }

    public function setTotal(string $total): self
    {
        $this->total = $total;

        return $this;
    }

    /**
     * @return \Doctrine\Common\Collections\Collection;
     */
    public function getQuoteLineItems(): Collection {
        return $this->quoteLineItems;
    }

    public function addQuoteLineItem(QuoteLineItem $quoteLineItem): self
    {
        if (!$this->quoteLineItems->contains($quoteLineItem)) {
            $this->quoteLineItems[] = $quoteLineItem;
            $quoteLineItem->setQuote($this);
        }

        return $this;
    }

    public function removeQuoteLineItem(QuoteLineItem $quoteLineItem): self
    {
        if ($this->quoteLineItems->contains($quoteLineItem)) {
            $this->quoteLineItems->removeElement($quoteLineItem);
            // set the owning side to null (unless already changed)
            if ($quoteLineItem->getQuote() === $this) {
                $quoteLineItem->setQuote(null);
            }
        }

        return $this;
    }

    public function __toString() {
        return $this->getSubject();
    }

    public function getOwner(): ?User
    {
        return $this->owner;
    }

    public function setOwner(?User $owner): self
    {
        $this->owner = $owner;

        return $this;
    }


}
