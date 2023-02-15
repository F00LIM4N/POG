<?php

namespace App\Entity;

use App\Repository\TwofaRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TwofaRepository::class)]
class Twofa
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $method_authentification = null;

    #[ORM\Column(length: 255)]
    private ?string $info_2fa = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMethodAuthentification(): ?string
    {
        return $this->method_authentification;
    }

    public function setMethodAuthentification(string $method_authentification): self
    {
        $this->method_authentification = $method_authentification;

        return $this;
    }

    public function getInfo2fa(): ?string
    {
        return $this->info_2fa;
    }

    public function setInfo2fa(string $info_2fa): self
    {
        $this->info_2fa = $info_2fa;

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
