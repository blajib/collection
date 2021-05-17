<?php

namespace App\Entity;
use App\Repository\HardwareRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;


/**
 * @ORM\Entity(repositoryClass=HardwareRepository::class)
 * @UniqueEntity("name")
 */
class Hardware
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
     * @ORM\Column(type="integer")
     */
    private $year;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Hardwaremaker", inversedBy="hardwares")
     */
    private $hardwareMaker;


    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Game", mappedBy="hardware")
     */
    private $games;

    /**
     * @ORM\Column (type="string", nullable=true)
     */
    private $imageLink;

    /**
     * @param mixed $users
     */
    public function setUsers($users): void
    {
        $this->users = $users;
    }

    /**
     * @return mixed
     */
    public function getUsers()
    {
        return $this->users;
    }



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
    public function getHardwareMaker()
    {
        return $this->hardwareMaker;
    }

    /**
     * @param mixed $hardwareMaker
     */
    public function setHardwareMaker($hardwareMaker): void
    {
        $this->hardwareMaker = $hardwareMaker;
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

    public function __toString()
    {
        return $this->name;
    }


}
