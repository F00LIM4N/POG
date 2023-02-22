<?php

namespace App\Entity;

use App\Repository\ResetpswdRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ResetpswdRepository::class)]
class Resetpswd
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne]
    #[ORM\JoinColumn(nullable: false)]
    private ?user $user = null;

    #[ORM\Column(length: 255)]
    private ?string $hashedToken_pswd = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $sendToken_pswd = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $expDate_pswd = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUser(?user $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getHashedTokenPswd(): ?string
    {
        return $this->hashedToken_pswd;
    }

    public function setHashedTokenPswd(string $hashedToken_pswd): self
    {
        $this->hashedToken_pswd = $hashedToken_pswd;

        return $this;
    }

    public function getSendTokenPswd(): ?\DateTimeInterface
    {
        return $this->sendToken_pswd;
    }

    public function setSendTokenPswd(\DateTimeInterface $sendToken_pswd): self
    {
        $this->sendToken_pswd = $sendToken_pswd;

        return $this;
    }

    public function getExpDatePswd(): ?\DateTimeInterface
    {
        return $this->expDate_pswd;
    }

    public function setExpDatePswd(\DateTimeInterface $expDate_pswd): self
    {
        $this->expDate_pswd = $expDate_pswd;

        return $this;
    }
}
