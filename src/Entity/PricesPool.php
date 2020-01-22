<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\PricesPoolRepository")
 */
class PricesPool
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
     * @ORM\OneToMany(targetEntity="App\Entity\BookingPool", mappedBy="price_pool")
     */
    private $bookingPools;

    public function __construct()
    {
        $this->bookingPools = new ArrayCollection();
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
     * @return Collection|BookingPool[]
     */
    public function getBookingPools(): Collection
    {
        return $this->bookingPools;
    }

    public function addBookingPool(BookingPool $bookingPool): self
    {
        if (!$this->bookingPools->contains($bookingPool)) {
            $this->bookingPools[] = $bookingPool;
            $bookingPool->setPricePool($this);
        }

        return $this;
    }

    public function removeBookingPool(BookingPool $bookingPool): self
    {
        if ($this->bookingPools->contains($bookingPool)) {
            $this->bookingPools->removeElement($bookingPool);
            // set the owning side to null (unless already changed)
            if ($bookingPool->getPricePool() === $this) {
                $bookingPool->setPricePool(null);
            }
        }

        return $this;
    }
}
