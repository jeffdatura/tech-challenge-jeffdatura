<?php

namespace App\Entity;

use App\Repository\ChenilleRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChenilleRepository::class)]
class Chenille
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\OneToMany(mappedBy: 'chenille', targetEntity: Proprio::class, orphanRemoval: true)]
    private $proprios;

    #[ORM\OneToMany(mappedBy: 'chenille', targetEntity: Animal::class, orphanRemoval: true)]
    private $animal;

    public function __construct()
    {
        $this->proprios = new ArrayCollection();
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
     * @return Collection<int, Proprio>
     */
    public function getProprios(): Collection
    {
        return $this->proprios;
    }

    public function addProprio(Proprio $proprio): self
    {
        if (!$this->proprios->contains($proprio)) {
            $this->proprios[] = $proprio;
            $proprio->setChenille($this);
        }

        return $this;
    }

    public function removeProprio(Proprio $proprio): self
    {
        if ($this->proprios->removeElement($proprio)) {
            // set the owning side to null (unless already changed)
            if ($proprio->getChenille() === $this) {
                $proprio->setChenille(null);
            }
        }

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
            $animal->setChenille($this);
        }

        return $this;
    }

    public function removeAnimal(Animal $animal): self
    {
        if ($this->animal->removeElement($animal)) {
            // set the owning side to null (unless already changed)
            if ($animal->getChenille() === $this) {
                $animal->setChenille(null);
            }
        }

        return $this;
    }

    public function __toString()
    {
        return $this->nom;
    }
}
