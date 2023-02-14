<?php

namespace App\Entity;

use App\Repository\AddressRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AddressRepository::class)]
class Address
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?city $city = null;

    #[ORM\Column(length: 255)]
    private ?string $name_address = null;

    #[ORM\Column]
    private ?int $number_address = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCity(): ?city
    {
        return $this->city;
    }

    public function setCity(?city $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getNameAddress(): ?string
    {
        return $this->name_address;
    }

    public function setNameAddress(string $name_address): self
    {
        $this->name_address = $name_address;

        return $this;
    }

    public function getNumberAddress(): ?int
    {
        return $this->number_address;
    }

    public function setNumberAddress(int $number_address): self
    {
        $this->number_address = $number_address;

        return $this;
    }
}
