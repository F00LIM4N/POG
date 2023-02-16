<?php

namespace App\Entity;

use App\Repository\PlatformRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PlatformRepository::class)]
class Platform
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $name_platform = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNamePlatform(): ?string
    {
        return $this->name_platform;
    }

    public function setNamePlatform(string $name_platform): self
    {
        $this->name_platform = $name_platform;

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
