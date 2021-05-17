<?php

namespace App\Entity;

use App\Repository\HardwaremakerRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HardwaremakerRepository::class)
 */
class Hardwaremaker
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $name;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Hardware", mappedBy="hardwareMaker")
     */
    private $hardwares;

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

    /**
     * @return mixed
     */
    public function getHardware()
    {
        return $this->hardwares;
    }

    /**
     * @param mixed $hardware
     */
    public function setHardware($hardware): void
    {
        $this->hardwares = $hardware;
    }

    public function __toString()
    {
        return $this->name;
    }


}
