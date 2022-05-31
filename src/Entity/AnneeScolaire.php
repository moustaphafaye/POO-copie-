<?php

namespace App\Entity;

use App\Repository\AnneeScolaireRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AnneeScolaireRepository::class)]
class AnneeScolaire
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 10)]
    private $libelleanne;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelleanne(): ?string
    {
        return $this->libelleanne;
    }

    public function setLibelleanne(string $libelleanne): self
    {
        $this->libelleanne = $libelleanne;

        return $this;
    }
}
