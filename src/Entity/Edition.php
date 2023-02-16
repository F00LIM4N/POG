<?php

namespace App\Entity;

use App\Repository\EditionRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: EditionRepository::class)]
class Edition
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name_edition = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameEdition(): ?string
    {
        return $this->name_edition;
    }

    public function setNameEdition(string $name_edition): self
    {
        $this->name_edition = $name_edition;

        return $this;
    }
    /**
     * Transform to string
     * 
     * @return string
     */
    public function __toString()
    {
        return (string) $this->getId();
    }
}
