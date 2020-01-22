<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RentingTypesRepository")
 */
class RentingTypes
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
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Rentings", mappedBy="renting_type")
     */
    private $rentings;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Media", mappedBy="renting_type")
     */
    private $media;

    public function __construct()
    {
        $this->rentings = new ArrayCollection();
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

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(int $price): self
    {
        $this->price = $price;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }

    /**
     * @return Collection|Rentings[]
     */
    public function getRentings(): Collection
    {
        return $this->rentings;
    }

    public function addRenting(Rentings $renting): self
    {
        if (!$this->rentings->contains($renting)) {
            $this->rentings[] = $renting;
            $renting->setRentingType($this);
        }

        return $this;
    }

    public function removeRenting(Rentings $renting): self
    {
        if ($this->rentings->contains($renting)) {
            $this->rentings->removeElement($renting);
            // set the owning side to null (unless already changed)
            if ($renting->getRentingType() === $this) {
                $renting->setRentingType(null);
            }
        }

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
            $medium->setRentingType($this);
        }

        return $this;
    }

    public function removeMedium(Media $medium): self
    {
        if ($this->media->contains($medium)) {
            $this->media->removeElement($medium);
            // set the owning side to null (unless already changed)
            if ($medium->getRentingType() === $this) {
                $medium->setRentingType(null);
            }
        }

        return $this;
    }
}
