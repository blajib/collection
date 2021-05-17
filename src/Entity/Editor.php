<?php

namespace App\Entity;

use App\Repository\EditorRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass=EditorRepository::class)
 * @UniqueEntity("name")
 */
class Editor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $year;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Game", mappedBy="editor")
     */
    private $games;


    /**
     * @ORM\Column (type="string", nullable=true)
     */
    private $imageLink;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): self
    {
        $this->name = $name;

        return $this;
    }

    public function getYear(): ?int
    {
        return $this->year;
    }

    public function setYear(int $year): self
    {
        $this->year = $year;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getGames()
    {
        return $this->games;
    }

    /**
     * @param mixed $games
     */
    public function setGames($games): void
    {
        $this->games = $games;
    }

    /**
     * @return mixed
     */
    public function getImageLink()
    {
        return $this->imageLink;
    }

    /**
     * @param mixed $imageLink
     */
    public function setImageLink($imageLink): void
    {
        $this->imageLink = $imageLink;
    }

}
