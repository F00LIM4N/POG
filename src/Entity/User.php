<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: UserRepository::class)]
class User
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?role $role = null;

    #[ORM\OneToOne(cascade: ['persist', 'remove'])]
    #[ORM\JoinColumn(nullable: false)]
    private ?address $address = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?twofa $authentification = null;

    #[ORM\Column(length: 255)]
    private ?string $lastname_user = null;

    #[ORM\Column(length: 255)]
    private ?string $firstname_user = null;

    #[ORM\Column(length: 255)]
    private ?string $email_user = null;

    #[ORM\Column(length: 255)]
    private ?string $password_user = null;

    #[ORM\Column(length: 255)]
    private ?string $token_user = null;

    #[ORM\Column(length: 255)]
    private ?string $pseudo_user = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateBirth_user = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $description_user = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $picture_user = null;

    #[ORM\Column]
    private ?bool $isMailValid = null;

    #[ORM\Column(length: 20, nullable: true)]
    private ?string $phone_user = null;

    #[ORM\Column]
    private ?bool $secu_enabled_user = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getRole(): ?role
    {
        return $this->role;
    }

    public function setRole(?role $role): self
    {
        $this->role = $role;

        return $this;
    }

    public function getAddress(): ?address
    {
        return $this->address;
    }

    public function setAddress(address $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getAuthentification(): ?twofa
    {
        return $this->authentification;
    }

    public function setAuthentification(?twofa $authentification): self
    {
        $this->authentification = $authentification;

        return $this;
    }

    public function getLastnameUser(): ?string
    {
        return $this->lastname_user;
    }

    public function setLastnameUser(string $lastname_user): self
    {
        $this->lastname_user = $lastname_user;

        return $this;
    }

    public function getFirstnameUser(): ?string
    {
        return $this->firstname_user;
    }

    public function setFirstnameUser(string $firstname_user): self
    {
        $this->firstname_user = $firstname_user;

        return $this;
    }

    public function getEmailUser(): ?string
    {
        return $this->email_user;
    }

    public function setEmailUser(string $email_user): self
    {
        $this->email_user = $email_user;

        return $this;
    }

    public function getPasswordUser(): ?string
    {
        return $this->password_user;
    }

    public function setPasswordUser(string $password_user): self
    {
        $this->password_user = $password_user;

        return $this;
    }

    public function getTokenUser(): ?string
    {
        return $this->token_user;
    }

    public function setTokenUser(string $token_user): self
    {
        $this->token_user = $token_user;

        return $this;
    }

    public function getPseudoUser(): ?string
    {
        return $this->pseudo_user;
    }

    public function setPseudoUser(string $pseudo_user): self
    {
        $this->pseudo_user = $pseudo_user;

        return $this;
    }

    public function getDateBirthUser(): ?\DateTimeInterface
    {
        return $this->dateBirth_user;
    }

    public function setDateBirthUser(\DateTimeInterface $dateBirth_user): self
    {
        $this->dateBirth_user = $dateBirth_user;

        return $this;
    }

    public function getDescriptionUser(): ?string
    {
        return $this->description_user;
    }

    public function setDescriptionUser(?string $description_user): self
    {
        $this->description_user = $description_user;

        return $this;
    }

    public function getPictureUser(): ?string
    {
        return $this->picture_user;
    }

    public function setPictureUser(?string $picture_user): self
    {
        $this->picture_user = $picture_user;

        return $this;
    }

    public function isIsMailValid(): ?bool
    {
        return $this->isMailValid;
    }

    public function setIsMailValid(bool $isMailValid): self
    {
        $this->isMailValid = $isMailValid;

        return $this;
    }

    public function getPhoneUser(): ?string
    {
        return $this->phone_user;
    }

    public function setPhoneUser(?string $phone_user): self
    {
        $this->phone_user = $phone_user;

        return $this;
    }

    public function isSecuEnabledUser(): ?bool
    {
        return $this->secu_enabled_user;
    }

    public function setSecuEnabledUser(bool $secu_enabled_user): self
    {
        $this->secu_enabled_user = $secu_enabled_user;

        return $this;
    }
}
