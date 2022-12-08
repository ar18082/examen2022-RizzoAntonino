<?php

namespace App\Entity;

use App\Repository\ChansonRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ChansonRepository::class)]
class Chanson
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $titre = null;

    #[ORM\Column(length: 255)]
    private ?string $nomAlbum = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $paroles = null;

    #[ORM\Column(length: 255)]
    private ?string $auteur = null;

    #[ORM\Column(length: 255)]
    private ?string $votes = null;

    #[ORM\ManyToOne(inversedBy: 'chansons')]
    private ?Genre $genre = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $created_at = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $date_sortie = null;

    public function __construct()
    {
        $this->created_at = new \DateTime;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getNomAlbum(): ?string
    {
        return $this->nomAlbum;
    }

    public function setNomAlbum(string $nomAlbum): self
    {
        $this->nomAlbum = $nomAlbum;

        return $this;
    }

    public function getParoles(): ?string
    {
        return $this->paroles;
    }

    public function setParoles(string $paroles): self
    {
        $this->paroles = $paroles;

        return $this;
    }

    public function getAuteur(): ?string
    {
        return $this->auteur;
    }

    public function setAuteur(string $auteur): self
    {
        $this->auteur = $auteur;

        return $this;
    }

    public function getVotes(): ?string
    {
        return $this->votes;
    }

    public function setVotes(string $votes): self
    {
        $this->votes = $votes;

        return $this;
    }

    public function getGenre(): ?Genre
    {
        return $this->genre;
    }

    public function setGenre(?Genre $genre): self
    {
        $this->genre = $genre;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getDateSortie(): ?\DateTimeInterface
    {
        return $this->date_sortie;
    }

    public function setDateSortie(?\DateTimeInterface $date_sortie): self
    {
        $this->date_sortie = $date_sortie;

        return $this;
    }
}
