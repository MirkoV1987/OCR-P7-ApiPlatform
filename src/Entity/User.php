<?php

namespace App\Entity;

use App\Uuid;
use App\Entity\Client;
use Cocur\Slugify\Slugify;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\UserInterface;
use ApiPlatform\Core\Annotation\ApiProperty;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\MaxDepth;

/**
 * @ORM\Table(name="users")
 * @ORM\Entity
 * 
 * @ApiResource(
 *     collectionOperations={
 *          "get",
 *          "post"={"status"=301}
 *     },
 *     itemOperations={
 *          "get"={"path"="/users/{id}"}
 *     },
 *     normalizationContext={
 *          "groups"={"list_users:read"},
 *          "enable_max_depth"=true,    
 *          "swagger_definition_name"="Read"},
 * 
 *     denormalizationContext={
 *          "groups"={"user:write"},
 *          "swagger_definition_name"="Write"}
 * )
 * 
 * @UniqueEntity("email")
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
     *
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=80)
     * @Groups({"list_users:read", "user:write"})
     */
    private $username;

    /**
     * @ORM\Column(type="string", length=150, unique=true)
     * @Groups({"list_users:read", "user:write"})
     */
    private $email;

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    // /**
    //  * @ORM\Column(type="string", length=255)
    //  * @Groups({"user:write"})
    //  */
    // private $slug;

    // /**
    //  * @ORM\Column(type="json", nullable=true)
    //  * @Groups({"list_users:read"})
    //  */
    // private $roles = [];

    /**
     * @ORM\ManyToOne(targetEntity="App\Entity\Client", inversedBy="users")
     * @Groups({"list_users:read"})
     * @MaxDepth(4)
     */
    private $client;

    /**
     * @Assert\Date
     * @var string A "Y-m-d H:i:s" formatted value
     * @ORM\Column(type="datetime", nullable = true)
     * @Groups({"list_users:read", "user:write"})
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

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
    }

    // /**
    //  * Initialize slug
    //  * @ORM\PrePersist
    //  */
    // public function initializeSlug()
    // {
    //     if (empty($this->slug)) {
    //         $slugify = new Slugify();
    //         $slug = $this->username;
    //         $this->slug = $slugify->slugify($slug);
    //     }
    // }

    //  /**
    //  * @return string|null
    //  */
    // public function getSlug(): ?string
    // {
    //     return $this->slug;
    // }

    // /**
    //  * @param string $slug
    //  * @return $this
    //  */
    // public function setSlug(string $slug): self
    // {
    //     $this->slug = $slug;

    //     return $this;
    // }

    public function getSalt()
    {
        return null;
    }
  
    public function eraseCredentials() {}

    public function getRoles(): array
    {
        $this->roles;

        return json_decode($roles);
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
}