<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingTaxRepository")
 */
class BookingTax
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Bookings", inversedBy="bookingTaxes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $booking;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PricesTax", inversedBy="bookingTaxes")
     * @ORM\JoinColumn(nullable=false)
     */
    private $price_tax;

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

    public function getBooking(): ?Bookings
    {
        return $this->booking;
    }

    public function setBooking(?Bookings $booking): self
    {
        $this->booking = $booking;

        return $this;
    }

    public function getPriceTax(): ?PricesTax
    {
        return $this->price_tax;
    }

    public function setPriceTax(?PricesTax $price_tax): self
    {
        $this->price_tax = $price_tax;

        return $this;
    }
}
