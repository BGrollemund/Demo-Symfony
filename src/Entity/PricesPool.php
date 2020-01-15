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
     * @ORM\OneToMany(targetEntity="App\Entity\RentingPool", mappedBy="pool")
     */
    private $rentingPools;

    public function __construct()
    {
        $this->rentingPools = new ArrayCollection();
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
            $rentingPool->setPool($this);
        }

        return $this;
    }

    public function removeRentingPool(RentingPool $rentingPool): self
    {
        if ($this->rentingPools->contains($rentingPool)) {
            $this->rentingPools->removeElement($rentingPool);
            // set the owning side to null (unless already changed)
            if ($rentingPool->getPool() === $this) {
                $rentingPool->setPool(null);
            }
        }

        return $this;
    }
}
