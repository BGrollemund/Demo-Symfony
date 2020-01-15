<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 */
class Users
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
    private $user_name;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\PdfsRenter", mappedBy="renter")
     */
    private $pdfsRenters;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Roles", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     */
    private $role;

    public function __construct()
    {
        $this->pdfsRenters = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserName(): ?string
    {
        return $this->user_name;
    }

    public function setUserName(string $user_name): self
    {
        $this->user_name = $user_name;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection|PdfsRenter[]
     */
    public function getPdfsRenters(): Collection
    {
        return $this->pdfsRenters;
    }

    public function addPdfsRenter(PdfsRenter $pdfsRenter): self
    {
        if (!$this->pdfsRenters->contains($pdfsRenter)) {
            $this->pdfsRenters[] = $pdfsRenter;
            $pdfsRenter->setRenter($this);
        }

        return $this;
    }

    public function removePdfsRenter(PdfsRenter $pdfsRenter): self
    {
        if ($this->pdfsRenters->contains($pdfsRenter)) {
            $this->pdfsRenters->removeElement($pdfsRenter);
            // set the owning side to null (unless already changed)
            if ($pdfsRenter->getRenter() === $this) {
                $pdfsRenter->setRenter(null);
            }
        }

        return $this;
    }

    public function getRole(): ?Roles
    {
        return $this->role;
    }

    public function setRole(?Roles $role): self
    {
        $this->role = $role;

        return $this;
    }
}
