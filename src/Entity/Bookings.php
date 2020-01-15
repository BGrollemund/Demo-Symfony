<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\BookingsRepository")
 */
class Bookings
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="date")
     */
    private $start_date;

    /**
     * @ORM\Column(type="date")
     */
    private $end_date;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Rentings", inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $renting;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Guests", inversedBy="bookings")
     * @ORM\JoinColumn(nullable=false)
     */
    private $guest;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PdfsBooking", mappedBy="booking")
     */
    private $pdfsBookings;

    public function __construct()
    {
        $this->pdfsBookings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStartDate(): ?\DateTimeInterface
    {
        return $this->start_date;
    }

    public function setStartDate(\DateTimeInterface $start_date): self
    {
        $this->start_date = $start_date;

        return $this;
    }

    public function getEndDate(): ?\DateTimeInterface
    {
        return $this->end_date;
    }

    public function setEndDate(\DateTimeInterface $end_date): self
    {
        $this->end_date = $end_date;

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

    public function getGuest(): ?Guests
    {
        return $this->guest;
    }

    public function setGuest(?Guests $guest): self
    {
        $this->guest = $guest;

        return $this;
    }

    /**
     * @return Collection|PdfsBooking[]
     */
    public function getPdfsBookings(): Collection
    {
        return $this->pdfsBookings;
    }

    public function addPdfsBooking(PdfsBooking $pdfsBooking): self
    {
        if (!$this->pdfsBookings->contains($pdfsBooking)) {
            $this->pdfsBookings[] = $pdfsBooking;
            $pdfsBooking->setBooking($this);
        }

        return $this;
    }

    public function removePdfsBooking(PdfsBooking $pdfsBooking): self
    {
        if ($this->pdfsBookings->contains($pdfsBooking)) {
            $this->pdfsBookings->removeElement($pdfsBooking);
            // set the owning side to null (unless already changed)
            if ($pdfsBooking->getBooking() === $this) {
                $pdfsBooking->setBooking(null);
            }
        }

        return $this;
    }
}
