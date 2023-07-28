<?php

namespace App\Entity;

use App\Repository\LivresRepository;
use App\Trait\TimeStampTrait;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


#[ORM\HasLifecycleCallbacks]
#[UniqueEntity('title', message: "Ce titre est déjà mis dans la liste")]
#[ORM\Entity(repositoryClass: LivresRepository::class)]
class Livres
{
    use TimeStampTrait;

    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[Assert\NotBlank(
        message: "Le titre est obligatoire"
    )]
    #[Assert\Regex(
        pattern: '/^[a-zA-Z-_ áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]+$/',
        match: true,
        message: "Le titre ne doit pas contenir de caractères spéciaux",
    )]
    #[ORM\Column(length: 255, unique:true)]
    private ?string $title = null;

    #[Assert\Regex(
        pattern: '/^[a-zA-Z-_ áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]+$/',
        match: true,
        message: "Le genre ne doit pas contenir de caractères spéciaux",
    )]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $genre = null;

    #[Assert\Regex(
        pattern: '/^[a-zA-Z-_ áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ]+$/',
        match: true,
        message: "Le nom de l'auteur ne doit pas contenir de caractères spéciaux",
    )]
    #[ORM\Column(length: 255, nullable: true)]
    private ?string $author = null;

    #[Assert\Regex(
        pattern: '/^([0-9]|10)$/',
        match: true,
        message: 'La note doit être entre 0 et 10 "Nombre ENTIER"',
    )]
    #[ORM\Column(length: 3, nullable: true)]
    private ?string $note = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $createdAt = null;

    #[ORM\Column]
    private ?\DateTimeImmutable $updatedAt = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getGenre(): ?string
    {
        return $this->genre;
    }

    public function setGenre(?string $genre): static
    {
        $this->genre = $genre;

        return $this;
    }

    public function getAuthor(): ?string
    {
        return $this->author;
    }

    public function setAuthor(?string $author): static
    {
        $this->author = $author;

        return $this;
    }

    public function getNote(): ?string
    {
        return $this->note;
    }

    public function setNote(?string $note): static
    {
        $this->note = $note;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(\DateTimeImmutable $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }
}
