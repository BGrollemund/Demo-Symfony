<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MediaRepository")
 */
class Media
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $file_name;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Rentings", inversedBy="medium")
     */
    private $rentings;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\RentingTypes", inversedBy="medium")
     */
    private $rentingTypes;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFileName(): ?string
    {
        return $this->file_name;
    }

    public function setFileName(string $file_name): self
    {
        $this->file_name = $file_name;

        return $this;
    }

    public function getRentings(): ?Rentings
    {
        return $this->rentings;
    }

    public function setRentings(?Rentings $rentings): self
    {
        $this->rentings = $rentings;

        return $this;
    }

    public function getRentingTypes(): ?RentingTypes
    {
        return $this->rentingTypes;
    }

    public function setRentingTypes(?RentingTypes $rentingTypes): self
    {
        $this->rentingTypes = $rentingTypes;

        return $this;
    }
}
