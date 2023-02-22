<?php

namespace App\Entity;

use App\Repository\FeatureRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FeatureRepository::class)]
class Feature
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?User $user = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Game $game = null;

    #[ORM\Column]
    private ?bool $wish = null;

    #[ORM\Column]
    private ?bool $fav = null;

    #[ORM\Column]
    private ?bool $recommand = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getGame(): ?Game
    {
        return $this->game;
    }

    public function setGame(?Game $game): self
    {
        $this->game = $game;

        return $this;
    }

    public function isWish(): ?bool
    {
        return $this->wish;
    }

    public function setWish(bool $wish): self
    {
        $this->wish = $wish;

        return $this;
    }

    public function isFav(): ?bool
    {
        return $this->fav;
    }

    public function setFav(bool $fav): self
    {
        $this->fav = $fav;

        return $this;
    }

    public function isRecommand(): ?bool
    {
        return $this->recommand;
    }

    public function setRecommand(bool $recommand): self
    {
        $this->recommand = $recommand;

        return $this;
    }
}
