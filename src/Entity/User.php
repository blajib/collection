<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface
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
    private $email;

    /**
     * @var array
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password;

    /**
     * @var ArrayCollection
     * @ORM\ManyToMany(targetEntity="App\Entity\Game",cascade={"persist"})
     */
    private $games;

    /**
     * @ORM\ManyToMany(targetEntity="App\Entity\Hardware",cascade={"persist"})
     */
    private $hardwares;



    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }


    public function getRoles()
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles)
    {
        $this->roles = $roles;

        return $this;
    }

    public function getSalt()
    {
        // TODO: Implement getSalt() method.
    }

    public function getUsername()
    {
        return $this->email;
    }

    public function eraseCredentials()
    {
        // TODO: Implement eraseCredentials() method.
    }

    /**
     * @return ArrayCollection
     */
    public function getGames(): ArrayCollection
    {
        $array = $this->games->toArray();
        $arrayCollection = new ArrayCollection($array);
        /*return $this->games;*/
        return $arrayCollection;
    }

    /**
     * @param ArrayCollection $games
     */
    public function setGames(ArrayCollection $games): void
    {
        $this->games = $games;
    }

    public function addGame(Game $game): self
    {

            $this->games[] = $game;
            //$game->setUsers($this);


        return $this;
    }

    public function removeGame(Game $game): self
    {
        $this->games->removeElement($game);

        return $this;
    }

    /**
     * @return mixed
     */
    public function getHardwares()
    {
        return $this->hardwares;
    }

    /**
     * @param mixed $hardwares
     */
    public function setHardwares($hardwares): void
    {
        $this->hardwares = $hardwares;
    }
    public function addHardware(Hardware $hardware): self
    {

        $this->hardwares[] = $hardware;
        //$hardware->setUsers($this);


        return $this;
    }

    public function removeHardware(Hardware $hardware): self
    {
        if ($this->hardwares->removeElement($hardware)) {
            // set the owning side to null (unless already changed)
            if ($hardware->getUsers() === $this) {
                $hardware->setUsers(null);
            }
        }

        return $this;
    }


}
