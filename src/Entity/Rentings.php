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
     * @ORM\Column(type="string", length=100)
     */
    private $location;

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
     * @ORM\ManyToOne(targetEntity="App\Entity\Users", inversedBy="rentings")
     */
    private $users;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Media", mappedBy="renting")
     */
    private $media;

    public function __construct()
    {
        $this->bookings = new ArrayCollection();
        $this->media = new ArrayCollection();
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

    public function getLocation(): ?string
    {
        return $this->location;
    }

    public function setLocation(string $location): self
    {
        $this->location = $location;

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

    public function getUsers(): ?Users
    {
        return $this->users;
    }

    public function setUsers(?Users $users): self
    {
        $this->users = $users;

        return $this;
    }

    /**
     * @return Collection|Media[]
     */
    public function getMedia(): Collection
    {
        return $this->media;
    }

    public function addMedium(Media $medium): self
    {
        if (!$this->media->contains($medium)) {
            $this->media[] = $medium;
            $medium->setRenting($this);
        }

        return $this;
    }

    public function removeMedium(Media $medium): self
    {
        if ($this->media->contains($medium)) {
            $this->media->removeElement($medium);
            // set the owning side to null (unless already changed)
            if ($medium->getRenting() === $this) {
                $medium->setRenting(null);
            }
        }

        return $this;
    }
}
