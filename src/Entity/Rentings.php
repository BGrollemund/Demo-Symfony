<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RentingsRepository")
 */
class Rentings
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
     * @ORM\OneToMany(targetEntity="App\Entity\Bookings", mappedBy="renting")
     */
    private $bookings;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\RentingTypes", inversedBy="rentings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $renting_type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\RenterTypes", inversedBy="rentings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $renter_type;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Media", mappedBy="rentings")
     */
    private $medium;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Users", inversedBy="rentings")
     */
    private $renter;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RentingPool", mappedBy="renting")
     */
    private $rentingPools;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\RentingTax", mappedBy="renting")
     */
    private $rentingTaxes;

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
        $this->medium = new ArrayCollection();
        $this->renter = new ArrayCollection();
        $this->rentingPools = new ArrayCollection();
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

    /**
     * @return Collection|Bookings[]
     */
    public function getBookings(): Collection
    {
        return $this->bookings;
    }

    public function addBooking(Bookings $booking): self
    {
        if (!$this->bookings->contains($booking)) {
            $this->bookings[] = $booking;
            $booking->setRenting($this);
        }

        return $this;
    }

    public function removeBooking(Bookings $booking): self
    {
        if ($this->bookings->contains($booking)) {
            $this->bookings->removeElement($booking);
            // set the owning side to null (unless already changed)
            if ($booking->getRenting() === $this) {
                $booking->setRenting(null);
            }
        }

        return $this;
    }

    public function getRentingType(): ?RentingTypes
    {
        return $this->renting_type;
    }

    public function setRentingType(?RentingTypes $renting_type): self
    {
        $this->renting_type = $renting_type;

        return $this;
    }

    public function getRenterType(): ?RenterTypes
    {
        return $this->renter_type;
    }

    public function setRenterType(?RenterTypes $renter_type): self
    {
        $this->renter_type = $renter_type;

        return $this;
    }

    /**
     * @return Collection|Media[]
     */
    public function getMedium(): Collection
    {
        return $this->medium;
    }

    public function addMedium(Media $medium): self
    {
        if (!$this->medium->contains($medium)) {
            $this->medium[] = $medium;
            $medium->setRentings($this);
        }

        return $this;
    }

    public function removeMedium(Media $medium): self
    {
        if ($this->medium->contains($medium)) {
            $this->medium->removeElement($medium);
            // set the owning side to null (unless already changed)
            if ($medium->getRentings() === $this) {
                $medium->setRentings(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Users[]
     */
    public function getRenter(): Collection
    {
        return $this->renter;
    }

    public function addRenter(Users $renter): self
    {
        if (!$this->renter->contains($renter)) {
            $this->renter[] = $renter;
        }

        return $this;
    }

    public function removeRenter(Users $renter): self
    {
        if ($this->renter->contains($renter)) {
            $this->renter->removeElement($renter);
        }

        return $this;
    }

    /**
     * @return Collection|RentingPool[]
     */
    public function getRentingPools(): Collection
    {
        return $this->rentingPools;
    }

    public function addRentingPool(RentingPool $rentingPool): self
    {
        if (!$this->rentingPools->contains($rentingPool)) {
            $this->rentingPools[] = $rentingPool;
            $rentingPool->setRenting($this);
        }

        return $this;
    }

    public function removeRentingPool(RentingPool $rentingPool): self
    {
        if ($this->rentingPools->contains($rentingPool)) {
            $this->rentingPools->removeElement($rentingPool);
            // set the owning side to null (unless already changed)
            if ($rentingPool->getRenting() === $this) {
                $rentingPool->setRenting(null);
            }
        }

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
            $rentingTax->setRenting($this);
        }

        return $this;
    }

    public function removeRentingTax(RentingTax $rentingTax): self
    {
        if ($this->rentingTaxes->contains($rentingTax)) {
            $this->rentingTaxes->removeElement($rentingTax);
            // set the owning side to null (unless already changed)
            if ($rentingTax->getRenting() === $this) {
                $rentingTax->setRenting(null);
            }
        }

        return $this;
    }
}
