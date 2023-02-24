<?php

namespace App\Entity;

use App\Repository\RoomRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: RoomRepository::class)]
class Room
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title_room = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_room = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content_room = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitleRoom(): ?string
    {
        return $this->title_room;
    }

    public function setTitleRoom(string $title_room): self
    {
        $this->title_room = $title_room;

        return $this;
    }

    public function getDateRoom(): ?\DateTimeInterface
    {
        return $this->date_room;
    }

    public function setDateRoom(\DateTimeInterface $date_room): self
    {
        $this->date_room = $date_room;

        return $this;
    }

    public function getContentRoom(): ?string
    {
        return $this->content_room;
    }

    public function setContentRoom(string $content_room): self
    {
        $this->content_room = $content_room;

        return $this;
    }
}
