<?php

namespace App\Entity;

use App\Repository\MailTemplateRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: MailTemplateRepository::class)]
class MailTemplate
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $object_mailTemplate = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $content_mailTemplate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date_mailTemplate = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getObjectMailTemplate(): ?string
    {
        return $this->object_mailTemplate;
    }

    public function setObjectMailTemplate(string $object_mailTemplate): self
    {
        $this->object_mailTemplate = $object_mailTemplate;

        return $this;
    }

    public function getContentMailTemplate(): ?string
    {
        return $this->content_mailTemplate;
    }

    public function setContentMailTemplate(string $content_mailTemplate): self
    {
        $this->content_mailTemplate = $content_mailTemplate;

        return $this;
    }

    public function getDateMailTemplate(): ?\DateTimeInterface
    {
        return $this->date_mailTemplate;
    }

    public function setDateMailTemplate(\DateTimeInterface $date_mailTemplate): self
    {
        $this->date_mailTemplate = $date_mailTemplate;

        return $this;
    }
}
