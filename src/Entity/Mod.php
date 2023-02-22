<?php

namespace App\Entity;

use App\Repository\ModRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ModRepository::class)]
#[ORM\Table(name: '`mod`')]
class Mod
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name_mod = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameMod(): ?string
    {
        return $this->name_mod;
    }

    public function setNameMod(string $name_mod): self
    {
        $this->name_mod = $name_mod;

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
