<?php

namespace App\Entity;

use App\Repository\ProprioRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ProprioRepository::class)]
class Proprio
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\OneToMany(mappedBy: 'proprio', targetEntity: Animal::class, orphanRemoval: true)]
    private $animal;

    #[ORM\ManyToOne(targetEntity: Chenille::class, inversedBy: 'proprios')]
    #[ORM\JoinColumn(nullable: false)]
    private $chenille;

    public function __construct()
    {
        $this->animal = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * @return Collection<int, Animal>
     */
    public function getAnimal(): Collection
    {
        return $this->animal;
    }

    public function addAnimal(Animal $animal): self
    {
        if (!$this->animal->contains($animal)) {
            $this->animal[] = $animal;
            $animal->setProprio($this);
        }

        return $this;
    }

    public function removeAnimal(Animal $animal): self
    {
        if ($this->animal->removeElement($animal)) {
            // set the owning side to null (unless already changed)
            if ($animal->getProprio() === $this) {
                $animal->setProprio(null);
            }
        }

        return $this;
    }

    public function getChenille(): ?Chenille
    {
        return $this->chenille;
    }

    public function setChenille(?Chenille $chenille): self
    {
        $this->chenille = $chenille;

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }
}
