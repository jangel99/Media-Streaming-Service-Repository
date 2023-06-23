<?php

namespace App\Entity;

use App\Repository\ComentsRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: ComentsRepository::class)]
class Coments
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $coment = null;

    #[ORM\Column]
    private ?int $movieID = null;

    #[ORM\Column]
    private ?int $userID = null;

    #[ORM\Column(length: 255)]
    private ?string $userName = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getComent(): ?string
    {
        return $this->coment;
    }

    public function setComent(string $coment): self
    {
        $this->coment = $coment;

        return $this;
    }

    public function getMovieID(): ?int
    {
        return $this->movieID;
    }

    public function setMovieID(int $movieID): self
    {
        $this->movieID = $movieID;

        return $this;
    }

    public function getUserID(): ?int
    {
        return $this->userID;
    }

    public function setUserID(int $userID): self
    {
        $this->userID = $userID;

        return $this;
    }

    public function getUserName(): ?string
    {
        return $this->userName;
    }

    public function setUserName(string $userName): self
    {
        $this->userName = $userName;

        return $this;
    }
}
