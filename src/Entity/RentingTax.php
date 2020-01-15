<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RentingTaxRepository")
 */
class RentingTax
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $num_guests;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Rentings", inversedBy="rentingTaxes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $renting;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PricesTax", inversedBy="rentingTaxes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tax;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumGuests(): ?int
    {
        return $this->num_guests;
    }

    public function setNumGuests(int $num_guests): self
    {
        $this->num_guests = $num_guests;

        return $this;
    }

    public function getRenting(): ?Rentings
    {
        return $this->renting;
    }

    public function setRenting(?Rentings $renting): self
    {
        $this->renting = $renting;

        return $this;
    }

    public function getTax(): ?PricesTax
    {
        return $this->tax;
    }

    public function setTax(?PricesTax $tax): self
    {
        $this->tax = $tax;

        return $this;
    }
}
