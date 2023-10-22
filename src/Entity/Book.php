<?php

namespace App\Entity;

use App\Repository\BookRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;


#[ORM\Entity(repositoryClass: BookRepository::class)]
class Book
{
    #[ORM\Id]
    //#[ORM\GeneratedValue]
    #[ORM\Column(name:'reference')]
    private ?int $ref= null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(length: 255)]
    private ?string $category = null;

    #[ORM\Column]
    private ?bool $published = null;

    #[ORM\ManyToOne(inversedBy: 'books')]
    #[ORM\JoinColumn(name:'cin_auth',referencedColumnName:'cin')]
    private ?Author $auth = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $publicationDate = null;

    //L'entité "Book" est l'entité propriétaire (Many) car plusieurs livres peuvent être liés à un même auteur.
    //L'entité "Author" est l'entité inverse (One) car un auteur peut être associé à plusieurs livres.
    
    
    public function getRef(): ?int
    {
        return $this->ref;
    }
    public function setRef(?int $ref): static
{
    $this->ref = $ref;
    return $this;
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

    public function getCategory(): ?string
    {
        return $this->category;
    }

    public function setCategory(string $category): static
    {
        $this->category = $category;

        return $this;
    }

    public function isPublished(): ?bool
    {
        return $this->published;
    }

    public function setPublished(bool $published): static
    {
        $this->published = $published;

        return $this;
    }

    public function getAuth(): ?Author
    {
        return $this->auth;
    }

    public function setAuth(?Author $auth): static
    {
        $this->auth = $auth;

        return $this;
    }

    public function getPublicationDate(): ?\DateTimeInterface
    {
        return $this->publicationDate;
    }

    public function setPublicationDate(\DateTimeInterface $publicationDate): static
    {
        $this->publicationDate = $publicationDate;

        return $this;
    }
}
