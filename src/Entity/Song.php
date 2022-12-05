<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\SongRepository;
use ApiPlatform\Metadata\Link;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Post;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: SongRepository::class)]
#[ApiResource(
    paginationItemsPerPage: 5
)]
#[ApiResource(
    uriTemplate: '/artiste/{id_art}/album/{id_alb}/song/{id}',
    uriVariables: [
        'id-art' => new Link(
            fromClass: Artiste::class,
            fromProperty: 'albums'
        ),
        'id-alb' => new Link(
            fromClass: Album::class,
            fromProperty: 'songs'
        ),
        'id' => new Link(
            fromClass: Song::class,
            fromProperty: 'title'
        )
        ],
        operations: [new Get(), new Post()]
)]
class Song
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column]
    private ?int $length = null;

    #[ORM\ManyToOne]
    private ?Album $album = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

        return $this;
    }

    public function getLength(): ?int
    {
        return $this->length;
    }

    public function setLength(int $length): self
    {
        $this->length = $length;

        return $this;
    }

    public function getAlbum(): ?album
    {
        return $this->album;
    }

    public function setAlbum(?album $album): self
    {
        $this->album = $album;
        $album->addSong($this);

        return $this;
    }
}
