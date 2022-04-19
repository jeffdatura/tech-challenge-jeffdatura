<?php

namespace App\Entity;

use App\Repository\AnimalRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnimalRepository::class)]
class Animal
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 255)]
    private $nom;

    #[ORM\Column(type: 'string', length: 255)]
    private $race;

    #[ORM\ManyToOne(targetEntity: Proprio::class, inversedBy: 'animal')]
    #[ORM\JoinColumn(nullable: false)]
    private $proprio;

    #[ORM\ManyToOne(targetEntity: Chenille::class, inversedBy: 'animal')]
    #[ORM\JoinColumn(nullable: false)]
    private $chenille;

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

    public function getRace(): ?string
    {
        return $this->race;
    }

    public function setRace(string $race): self
    {
        $this->race = $race;

        return $this;
    }

    public function getProprio(): ?Proprio
    {
        return $this->proprio;
    }

    public function setProprio(?Proprio $proprio): self
    {
        $this->proprio = $proprio;

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
}
