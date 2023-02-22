<?php

namespace App\Entity;

use App\Repository\PegiRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PegiRepository::class)]
class Pegi
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 10)]
    private ?string $value_pegi = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getValuePegi(): ?string
    {
        return $this->value_pegi;
    }

    public function setValuePegi(string $value_pegi): self
    {
        $this->value_pegi = $value_pegi;

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
