<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingPoolRepository")
 */
class BookingPool
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Bookings", inversedBy="bookingPools")
     * @ORM\JoinColumn(nullable=false)
     */
    private $booking;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\PricesPool", inversedBy="bookingPools")
     * @ORM\JoinColumn(nullable=false)
     */
    private $price_pool;

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

    public function getPricePool(): ?PricesPool
    {
        return $this->price_pool;
    }

    public function setPricePool(?PricesPool $price_pool): self
    {
        $this->price_pool = $price_pool;

        return $this;
    }
}
