<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\Annotation;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @UniqueEntity("username")
 * @UniqueEntity("email")
 */
class User extends BaseUser {

    /**
     * User constructor.
     */
    public function __construct() {
        parent::__construct();
        $this->contacts = new ArrayCollection();
        $this->quotes = new ArrayCollection();
    }

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    protected $id;


    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $phone;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $mobile;

    /**
     * @ORM\Column(type="string", length=120, nullable=true)
     */
    protected $firstName;

    /**
     * @ORM\Column(type="string", length=120, nullable=true)
     */
    protected $lastName;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Contact", mappedBy="owner")
     */
    private $contacts;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Quote", mappedBy="owner")
     */
    private $quotes;

    public function getId(): ?int
    {
        return $this->id;
    }


    public function getPhone(): ?string
    {
        return $this->phone;
    }

    public function setPhone(?string $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    public function setMobile(?string $mobile): self
    {
        $this->mobile = $mobile;

        return $this;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(?string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(?string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    /**
     * @return Collection|Contact[]
     */
    public function getContacts(): Collection
    {
        return $this->contacts;
    }

    public function addContact(Contact $contact): self
    {
        if (!$this->contacts->contains($contact)) {
            $this->contacts[] = $contact;
            $contact->setOwner($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contacts->contains($contact)) {
            $this->contacts->removeElement($contact);
            // set the owning side to null (unless already changed)
            if ($contact->getOwner() === $this) {
                $contact->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Quote[]
     */
    public function getQuotes(): Collection
    {
        return $this->quotes;
    }

    public function addQuote(Quote $quote): self
    {
        if (!$this->quotes->contains($quote)) {
            $this->quotes[] = $quote;
            $quote->setOwner($this);
        }

        return $this;
    }

    public function removeQuote(Quote $quote): self
    {
        if ($this->quotes->contains($quote)) {
            $this->quotes->removeElement($quote);
            // set the owning side to null (unless already changed)
            if ($quote->getOwner() === $this) {
                $quote->setOwner(null);
            }
        }

        return $this;
    }

    /**
     * @return string
     */
    public function __toString() {
        return $this->getFirstName() . ' ' . $this->getLastName();
    }


}
