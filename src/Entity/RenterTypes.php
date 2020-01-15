<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\RenterTypesRepository")
 */
class RenterTypes
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
     * @ORM\OneToMany(targetEntity="App\Entity\Rentings", mappedBy="renter_type")
     */
    private $rentings;

    public function __construct()
    {
        $this->rentings = new ArrayCollection();
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
            $renting->setRenterType($this);
        }

        return $this;
    }

    public function removeRenting(Rentings $renting): self
    {
        if ($this->rentings->contains($renting)) {
            $this->rentings->removeElement($renting);
            // set the owning side to null (unless already changed)
            if ($renting->getRenterType() === $this) {
                $renting->setRenterType(null);
            }
        }

        return $this;
    }
}
