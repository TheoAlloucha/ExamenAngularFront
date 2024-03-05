<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use App\Repository\VoyageRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VoyageRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(
        ),
        new Get(),
        new Post(
            security: "is_granted('ROLE_ADMIN')"
        ),
        new Put(
            security: "is_granted('ROLE_ADMIN')"
        ),
        new Delete(
            security: "is_granted('ROLE_ADMIN')"
        )
    ]

)]
class Voyage
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $destination = null;

    #[ORM\Column]
    private ?float $lattitude = null;

    #[ORM\Column(length: 255)]
    private ?float $longitude = null;

    #[ORM\Column(length: 255)]
    private ?string $type = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    private ?Image $mainPicture = null;

    #[ORM\OneToMany(mappedBy: 'voyage', targetEntity: Image::class, cascade: ['persist', 'remove'])]
    private Collection $pictures;

    #[ORM\Column]
    private ?int $nbStar = null;

    public function __construct()
    {
        $this->pictures = new ArrayCollection();
    }

    public function __toString(): string
    {
       return $this->destination;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDestination(): ?string
    {
        return $this->destination;
    }

    public function setDestination(string $destination): static
    {
        $this->destination = $destination;

        return $this;
    }

    public function getLattitude(): ?float
    {
        return $this->lattitude;
    }

    public function setLattitude(float $lattitude): static
    {
        $this->lattitude = $lattitude;

        return $this;
    }

    public function getLongitude(): ?float
    {
        return $this->longitude;
    }

    public function setLongitude(float $longitude): static
    {
        $this->longitude = $longitude;

        return $this;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): static
    {
        $this->type = $type;

        return $this;
    }

    public function getMainPicture(): ?Image
    {
        return $this->mainPicture;
    }

    public function setMainPicture(?Image $mainPicture): static
    {
        $this->mainPicture = $mainPicture;

        return $this;
    }

    /**
     * @return Collection<int, Image>
     */
    public function getPictures(): Collection
    {
        return $this->pictures;
    }

    public function addPicture(Image $picture): static
    {
        if (!$this->pictures->contains($picture)) {
            $this->pictures->add($picture);
            $picture->setVoyage($this);
        }

        return $this;
    }

    public function removePicture(Image $picture): static
    {
        if ($this->pictures->removeElement($picture)) {
            // set the owning side to null (unless already changed)
            if ($picture->getVoyage() === $this) {
                $picture->setVoyage(null);
            }
        }

        return $this;
    }

    public function getNbStar(): ?int
    {
        return $this->nbStar;
    }

    public function setNbStar(int $nbStar): static
    {
        $this->nbStar = $nbStar;

        return $this;
    }
}
