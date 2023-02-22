<?php

namespace App\Entity;

use App\Repository\GameRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: GameRepository::class)]
class Game
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    private ?Promo $promo = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Development $development = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Edition $edition = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?Pegi $pegi = null;

    #[ORM\Column(length: 255)]
    private ?string $name_game = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $releaseDate_game = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $picture_game = null;

    #[ORM\Column]
    private ?float $price_game = null;

    #[ORM\Column(nullable: true)]
    private ?float $note_game = null;

    #[ORM\Column]
    private ?bool $isAvailable = null;

    #[ORM\ManyToMany(targetEntity: Category::class)]
    private Collection $category;

    #[ORM\ManyToMany(targetEntity: Mod::class)]
    private Collection $gamemode;

    #[ORM\ManyToMany(targetEntity: Order::class)]
    private Collection $gameorder;

    #[ORM\ManyToMany(targetEntity: Platform::class)]
    private Collection $platform;

    public function __construct()
    {
        $this->category = new ArrayCollection();
        $this->gamemode = new ArrayCollection();
        $this->gameorder = new ArrayCollection();
        $this->platform = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPromo(): ?Promo
    {
        return $this->promo;
    }

    public function setPromo(?Promo $promo): self
    {
        $this->promo = $promo;

        return $this;
    }

    public function getDevelopment(): ?Development
    {
        return $this->development;
    }

    public function setDevelopment(?Development $development): self
    {
        $this->development = $development;

        return $this;
    }

    public function getEdition(): ?Edition
    {
        return $this->edition;
    }

    public function setEdition(?Edition $edition): self
    {
        $this->edition = $edition;

        return $this;
    }

    public function getPegi(): ?Pegi
    {
        return $this->pegi;
    }

    public function setPegi(?Pegi $pegi): self
    {
        $this->pegi = $pegi;

        return $this;
    }

    public function getNameGame(): ?string
    {
        return $this->name_game;
    }

    public function setNameGame(string $name_game): self
    {
        $this->name_game = $name_game;

        return $this;
    }

    public function getReleaseDateGame(): ?\DateTimeInterface
    {
        return $this->releaseDate_game;
    }

    public function setReleaseDateGame(\DateTimeInterface $releaseDate_game): self
    {
        $this->releaseDate_game = $releaseDate_game;

        return $this;
    }

    public function getPictureGame(): ?string
    {
        return $this->picture_game;
    }

    public function setPictureGame(string $picture_game): self
    {
        $this->picture_game = $picture_game;

        return $this;
    }

    public function getPriceGame(): ?float
    {
        return $this->price_game;
    }

    public function setPriceGame(float $price_game): self
    {
        $this->price_game = $price_game;

        return $this;
    }

    public function getNoteGame(): ?float
    {
        return $this->note_game;
    }

    public function setNoteGame(?float $note_game): self
    {
        $this->note_game = $note_game;

        return $this;
    }

    public function isIsAvailable(): ?bool
    {
        return $this->isAvailable;
    }

    public function setIsAvailable(bool $isAvailable): self
    {
        $this->isAvailable = $isAvailable;

        return $this;
    }

    /**
     * @return Collection<int, category>
     */
    public function getCategory(): Collection
    {
        return $this->category;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->category->contains($category)) {
            $this->category->add($category);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        $this->category->removeElement($category);

        return $this;
    }

    /**
     * @return Collection<int, mod>
     */
    public function getGamemode(): Collection
    {
        return $this->gamemode;
    }

    public function addGamemode(Mod $gamemode): self
    {
        if (!$this->gamemode->contains($gamemode)) {
            $this->gamemode->add($gamemode);
        }

        return $this;
    }

    public function removeGamemode(Mod $gamemode): self
    {
        $this->gamemode->removeElement($gamemode);

        return $this;
    }

    /**
     * @return Collection<int, order>
     */
    public function getGameorder(): Collection
    {
        return $this->gameorder;
    }

    public function addGameorder(Order $gameorder): self
    {
        if (!$this->gameorder->contains($gameorder)) {
            $this->gameorder->add($gameorder);
        }

        return $this;
    }

    public function removeGameorder(Order $gameorder): self
    {
        $this->gameorder->removeElement($gameorder);

        return $this;
    }

    /**
     * @return Collection<int, platform>
     */
    public function getPlatform(): Collection
    {
        return $this->platform;
    }

    public function addPlatform(Platform $platform): self
    {
        if (!$this->platform->contains($platform)) {
            $this->platform->add($platform);
        }

        return $this;
    }

    public function removePlatform(Platform $platform): self
    {
        $this->platform->removeElement($platform);

        return $this;
    }
}
