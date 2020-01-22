<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Exception;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * @ORM\Entity(repositoryClass="App\Repository\MediaRepository")
 *
 * @Vich\Uploadable
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
     * @var File|null
     * @Vich\UploadableField(mapping="renting_image", fileNameProperty="file_name")
     *
     */
    private $imageFile;

    /**
     * @return File|null
     */
    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    /**
     * @param File|null $imageFile
     * @return Media
     * @throws Exception
     */
    public function setImageFile(?File $imageFile): Media
    {
        $this->imageFile = $imageFile;

        if( $this->imageFile instanceof UploadedFile ) {
            $this->updated_at = new DateTime('now');
        }

        return $this;
    }

    /**
     * @var File|null
     * @Vich\UploadableField(mapping="presentation_image", fileNameProperty="file_name")
     *
     */
    private $imageFilePresentation;

    /**
     * @return File|null
     */
    public function getImageFilePresentation(): ?File
    {
        return $this->imageFilePresentation;
    }

    /**
     * @param File|null $imageFilePresentation
     * @return Media
     * @throws Exception
     */
    public function setImageFilePresentation(?File $imageFilePresentation): Media
    {
        $this->imageFilePresentation = $imageFilePresentation;

        if( $this->imageFilePresentation instanceof UploadedFile ) {
            $this->updated_at = new DateTime('now');
        }

        return $this;
    }

    /**
     * @var File|null
     * @Vich\UploadableField(mapping="renting_types_image", fileNameProperty="file_name")
     *
     */
    private $imageFileRentingTypes;

    /**
     * @return File|null
     */
    public function getImageFileRentingTypes(): ?File
    {
        return $this->imageFileRentingTypes;
    }

    /**
     * @param File|null $imageFileRentingTypes
     * @return Media
     * @throws Exception
     */
    public function setImageFileRentingTypes(?File $imageFileRentingTypes): Media
    {
        $this->imageFileRentingTypes = $imageFileRentingTypes;

        if( $this->imageFileRentingTypes instanceof UploadedFile ) {
            $this->updated_at = new DateTime('now');
        }

        return $this;
    }

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Rentings", inversedBy="media")
     */
    private $renting;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\RentingTypes", inversedBy="media")
     */
    private $renting_type;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Presentation", inversedBy="media")
     */
    private $presentation;

    /**
     * @ORM\Column(type="datetime")
     */
    private $updated_at;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFileName(): ?string
    {
        return $this->file_name;
    }

    public function setFileName(?string $file_name): self
    {
        $this->file_name = $file_name;

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

    public function getRentingType(): ?RentingTypes
    {
        return $this->renting_type;
    }

    public function setRentingType(?RentingTypes $renting_type): self
    {
        $this->renting_type = $renting_type;

        return $this;
    }

    public function getPresentation(): ?Presentation
    {
        return $this->presentation;
    }

    public function setPresentation(?Presentation $presentation): self
    {
        $this->presentation = $presentation;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeInterface
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeInterface $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }
}
