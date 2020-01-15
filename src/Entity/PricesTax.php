<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PricesTaxRepository")
 */
class PricesTax
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
    private $label;

    /**
     * @ORM\Column(type="integer")
     */
    private $price;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RentingTax", mappedBy="tax")
     */
    private $rentingTaxes;

    public function __construct()
    {
        $this->rentingTaxes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLabel(): ?string
    {
        return $this->label;
    }

    public function setLabel(string $label): self
    {
        $this->label = $label;

        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    /**
     * @return Collection|RentingTax[]
     */
    public function getRentingTaxes(): Collection
    {
        return $this->rentingTaxes;
    }

    public function addRentingTax(RentingTax $rentingTax): self
    {
        if (!$this->rentingTaxes->contains($rentingTax)) {
            $this->rentingTaxes[] = $rentingTax;
            $rentingTax->setTax($this);
        }

        return $this;
    }

    public function removeRentingTax(RentingTax $rentingTax): self
    {
        if ($this->rentingTaxes->contains($rentingTax)) {
            $this->rentingTaxes->removeElement($rentingTax);
            // set the owning side to null (unless already changed)
            if ($rentingTax->getTax() === $this) {
                $rentingTax->setTax(null);
            }
        }

        return $this;
    }
}
