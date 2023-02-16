<?php

namespace App\Entity;

use App\Repository\DevelopmentRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: DevelopmentRepository::class)]
class Development
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name_development = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNameDevelopment(): ?string
    {
        return $this->name_development;
    }

    public function setNameDevelopment(string $name_development): self
    {
        $this->name_development = $name_development;

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
