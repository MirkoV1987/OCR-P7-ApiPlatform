<?php

namespace App\Entity;

use App\Entity\Client;
use App\DataPersister\UserDataPersister;
use App\Controller\ClientUserHandler;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Annotation\ApiSubresource;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ORM\Table(name="users") 
 * 
 * @ApiResource(
 *      collectionOperations={
 *          "special"={
 *              "method"="POST",
 *              "path"="/clients/{id}/users/create",
 *              "controller"=ClientUserHandler::class,
 *              "denormalization_context"={"groups"={"user.write"}},
 *              "defaults"={"_api_receive"=false},
 *          },
 *      },
 *      itemOperations={
 *          "get"={},
 *          "delete"={
 *              "method"="DELETE",
 *              "path"="clients/{id}/users/delete",
 *              "controller"=ClientUserHandler::class,
 *              "defaults"={"_api_receive"=false},
 *          }
 *      },
 *      attributes={
 *          "fetchEager": false,
 *          "normalization_context"={"groups"={"user.read"}}
 *     }
 * )
 * 
 * @UniqueEntity("email")
 * @UniqueEntity("username")
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 */
class User implements UserInterface
{
    //const ROLE_ADMIN = 'ROLE_ADMIN';
    const ROLE_USER = 'ROLE_USER';
    /**
     * @var int
     * @ORM\Column(type="integer")
     * @ORM\Id()
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ApiSubResource(maxDepth=0)
     * @Groups({"user.read"})
     *
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80, unique=true)
     * @Groups({"user.write", "user.read"})
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=150, unique=true)
     * @Groups({"user.write", "user.read"})
     */
    private $email;

    /**
     * @ORM\Column(type="integer")
     * @Groups({"user.write", "user.read"})
     */
    private $phone;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     * @Groups({"user.write"})
     */
    private $password;

    /**
     * @var string
     */
    private $plainPassword;

    /**
     * @ORM\Column(type="json", nullable=true)
     * @Groups({"user.write"})
     */
    private $roles = '';

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="users")
     * @ORM\JoinColumn(nullable=false)
     * @Groups({"user.read"})
     */
    private $client;

    /**
     * @Assert\Date
     * @var string A "Y-m-d H:i:s" formatted value
     * 
     * @ORM\Column(type="datetime", nullable = true)
     * @Groups({"user.write", "user.read"})
     */
    private $dateAdd;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->username;
    }

    public function setUsername(string $username): self
    {
        $this->username = $username;

        return $this;
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

    public function getPhone(): ?int
    {
        return $this->phone;
    }

    public function setPhone(int $phone): self
    {
        $this->phone = $phone;

        return $this;
    }

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    public function getPlainPassword(): ?string
    {
        return $this->plainPassword;
    }

    public function setPlainPassword(string $plainPassword): self
    {
        $this->plainPassword = $plainPassword;

        return $this;
    }

    public function getSalt()
    {
        return null;
    }
  
    public function eraseCredentials() 
    {
        $this->plainPassword = null;
    }

    public function getRoles()
    {
        return json_encode($this->roles);
    }

    /**
     * @return  self
     */ 
    public function setRoles($roles)
    {
        $this->roles = $roles;

        return $this;
    }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    public function getDateAdd(): ?\DateTimeInterface
    {
        return $this->dateAdd;
    }

    public function setDateAdd(\DateTimeInterface $dateAdd): self
    {
        $this->dateAdd = $dateAdd;

        return $this;
    }

    public function __toString()
    {
        return $this->username;
    }
}