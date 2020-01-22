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
     * @ORM\OneToMany(targetEntity="App\Entity\BookingTax", mappedBy="price_tax")
     */
    private $bookingTaxes;

    public function __construct()
    {
        $this->bookingTaxes = new ArrayCollection();
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
     * @return Collection|BookingTax[]
     */
    public function getBookingTaxes(): Collection
    {
        return $this->bookingTaxes;
    }

    public function addBookingTax(BookingTax $bookingTax): self
    {
        if (!$this->bookingTaxes->contains($bookingTax)) {
            $this->bookingTaxes[] = $bookingTax;
            $bookingTax->setPriceTax($this);
        }

        return $this;
    }

    public function removeBookingTax(BookingTax $bookingTax): self
    {
        if ($this->bookingTaxes->contains($bookingTax)) {
            $this->bookingTaxes->removeElement($bookingTax);
            // set the owning side to null (unless already changed)
            if ($bookingTax->getPriceTax() === $this) {
                $bookingTax->setPriceTax(null);
            }
        }

        return $this;
    }
}
