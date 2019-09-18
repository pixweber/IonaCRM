<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\AccountRepository")
 */
class Account
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Assert\NotBlank()
     */
    private $accountName;

    /**
     * @ORM\Column(type="string", length=200)
     */
    private $accountType;

    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    private $industry;

    /**
     * @ORM\Column(type="decimal", precision=25, scale=2, nullable=true)
     */
    private $annualRevenue;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $phone;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $otherPhone;

    /**
     * @ORM\Column(type="string", length=120, nullable=true)
     * @Assert\Email()
     */
    private $email1;

    /**
     * @ORM\Column(type="string", length=120, nullable=true)
     * @Assert\Email()
     */
    private $email2;

    /**
     * @ORM\Column(type="string", length=160, nullable=true)
     * @Assert\Url()
     */
    private $website;

    /**
     * @ORM\Column(type="string", length=30, nullable=true)
     */
    private $fax;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $billingStreet;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $billingCity;

    /**
     * @ORM\Column(type="string", length=12, nullable=true)
     */
    private $billingZipcode;

    /**
     * @ORM\Column(type="string", length=60, nullable=true)
     */
    private $billingCountry;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Contact", mappedBy="account")
     */
    private $contacts;

    public function __construct()
    {
        $this->contacts = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAccountName(): ?string
    {
        return $this->accountName;
    }

    public function setAccountName(string $accountName): self
    {
        $this->accountName = $accountName;

        return $this;
    }

    public function getAccountType(): ?string
    {
        return $this->accountType;
    }

    public function setAccountType(string $accountType): self
    {
        $this->accountType = $accountType;

        return $this;
    }

    public function getIndustry(): ?string
    {
        return $this->industry;
    }

    public function setIndustry(?string $industry): self
    {
        $this->industry = $industry;

        return $this;
    }

    public function getAnnualRevenue(): ?string
    {
        return $this->annualRevenue;
    }

    public function setAnnualRevenue(?string $annualRevenue): self
    {
        $this->annualRevenue = $annualRevenue;

        return $this;
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

    public function getOtherPhone(): ?string
    {
        return $this->otherPhone;
    }

    public function setOtherPhone(?string $otherPhone): self
    {
        $this->otherPhone = $otherPhone;

        return $this;
    }

    public function getEmail1(): ?string
    {
        return $this->email1;
    }

    public function setEmail1(?string $email1): self
    {
        $this->email1 = $email1;

        return $this;
    }

    public function getEmail2(): ?string
    {
        return $this->email2;
    }

    public function setEmail2(?string $email2): self
    {
        $this->email2 = $email2;

        return $this;
    }

    public function getWebsite(): ?string
    {
        return $this->website;
    }

    public function setWebsite(?string $website): self
    {
        $this->website = $website;

        return $this;
    }

    public function getFax(): ?string
    {
        return $this->fax;
    }

    public function setFax(?string $fax): self
    {
        $this->fax = $fax;

        return $this;
    }

    public function getBillingStreet(): ?string
    {
        return $this->billingStreet;
    }

    public function setBillingStreet(?string $billingStreet): self
    {
        $this->billingStreet = $billingStreet;

        return $this;
    }

    public function getBillingCity(): ?string
    {
        return $this->billingCity;
    }

    public function setBillingCity(?string $billingCity): self
    {
        $this->billingCity = $billingCity;

        return $this;
    }

    public function getBillingZipcode(): ?string
    {
        return $this->billingZipcode;
    }

    public function setBillingZipcode(?string $billingZipcode): self
    {
        $this->billingZipcode = $billingZipcode;

        return $this;
    }

    public function getBillingCountry(): ?string
    {
        return $this->billingCountry;
    }

    public function setBillingCountry(?string $billingCountry): self
    {
        $this->billingCountry = $billingCountry;

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
            $contact->setAccount($this);
        }

        return $this;
    }

    public function removeContact(Contact $contact): self
    {
        if ($this->contacts->contains($contact)) {
            $this->contacts->removeElement($contact);
            // set the owning side to null (unless already changed)
            if ($contact->getAccount() === $this) {
                $contact->setAccount(null);
            }
        }

        return $this;
    }
}
