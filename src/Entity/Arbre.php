<?php

namespace App\Entity;

use App\Repository\ArbreRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ArbreRepository::class)]
class Arbre
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateImplentation = null;

    #[ORM\Column]
    private ?bool $aRisque = null;

    #[ORM\ManyToOne(inversedBy: 'arbres')]
    private ?Parc $Parc = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateImplentation(): ?\DateTimeInterface
    {
        return $this->dateImplentation;
    }

    public function setDateImplentation(\DateTimeInterface $dateImplentation): static
    {
        $this->dateImplentation = $dateImplentation;

        return $this;
    }

    public function isARisque(): ?bool
    {
        return $this->aRisque;
    }

    public function setARisque(bool $aRisque): static
    {
        $this->aRisque = $aRisque;

        return $this;
    }

    public function getParc(): ?Parc
    {
        return $this->Parc;
    }

    public function setParc(?Parc $Parc): static
    {
        $this->Parc = $Parc;

        return $this;
    }
}
