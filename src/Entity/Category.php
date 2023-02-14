<?php

namespace App\Entity;

use App\Repository\CategoryRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CategoryRepository::class)]
class Category
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?promo $promo = null;

    #[ORM\Column(length: 255)]
    private ?string $name_category = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPromo(): ?promo
    {
        return $this->promo;
    }

    public function setPromo(?promo $promo): self
    {
        $this->promo = $promo;

        return $this;
    }

    public function getNameCategory(): ?string
    {
        return $this->name_category;
    }

    public function setNameCategory(string $name_category): self
    {
        $this->name_category = $name_category;

        return $this;
    }
}
