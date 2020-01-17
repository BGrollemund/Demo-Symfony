<?php

namespace App\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Serializable;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UsersRepository")
 */
class Users implements UserInterface, Serializable
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
    private $username;

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

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Rentings", mappedBy="renter")
     */
    private $rentings;


    private $roles;

    public function __construct()
    {
        $this->pdfsRenters = new ArrayCollection();
        $this->rentings = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

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
            $renting->addRenter($this);
        }

        return $this;
    }

    public function removeRenting(Rentings $renting): self
    {
        if ($this->rentings->contains($renting)) {
            $this->rentings->removeElement($renting);
            $renting->removeRenter($this);
        }

        return $this;
    }

    /**
     * String representation of object
     * @link https://php.net/manual/en/serializable.serialize.php
     * @return string the string representation of the object or null
     * @since 5.1.0
     */
    public function serialize()
    {
        return serialize([
            $this->id,
            $this->username,
            $this->password,
        ]);
    }

    /**
     * Constructs the object
     * @link https://php.net/manual/en/serializable.unserialize.php
     * @param string $serialized <p>
     * The string representation of the object.
     * </p>
     * @return void
     * @since 5.1.0
     */
    public function unserialize($serialized)
    {
        list(
            $this->id,
            $this->username,
            $this->password
        ) = unserialize( $serialized, ['allowed_classes' => false] );
    }

    /**
     * Returns the roles granted to the user.
     *
     *     public function getRoles()
     *     {
     *         return ['ROLE_USER'];
     *     }
     *
     * Alternatively, the roles might be stored on a ``roles`` property,
     * and populated in any number of different ways when the user object
     * is created.
     *
     * @return string[] The user roles
     */
    public function getRoles()
    {
        return [ $this->role->getLabel() ];
    }

    /**
     * Returns the salt that was originally used to encode the password.
     *
     * This can return null if the password was not encoded using a salt.
     *
     * @return string|null The salt
     */
    public function getSalt()
    {
        return 'camping3ETOILESespadrille_volante';
    }

    /**
     * Removes sensitive data from the user.
     *
     * This is important if, at any given point, sensitive information like
     * the plain-text password is stored on this object.
     */
    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }
}
