<?php

namespace App\Entity;

use DateTimeImmutable;
use App\Entity\UserCategory;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="There is already an account with this email")
 * @ORM\HasLifecycleCallbacks()
 * @Vich\Uploadable
 */
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $email;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $firstname;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $lastname;

    /**
     * @ORM\ManyToOne(targetEntity=UserCategory::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $userCategory;

    /**
     * @ORM\Column(type="datetime")
     */
    private $joinedOn;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $profilPicture;

    /**
     * @Vich\UploadableField(mapping="profilPicture", fileNameProperty="profilPicture")
     * 
     * @var File|null
     */
    private $profilPictureFile;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $age;

    /**
     * @ORM\Column(type="string")
     */
    private $height;

    /**
     * @ORM\Column(type="string")
     */
    private $weight;

    public function __toString()
    {
        return $this->email;
    }

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

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(string $firstname): self
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(string $lastname): self
    {
        $this->lastname = $lastname;

        return $this;
    }

    public function getUserCategory(): ?UserCategory
    {
        return $this->userCategory;
    }

    public function setUserCategory(?UserCategory $userCategory): self
    {
        $this->userCategory = $userCategory;

        return $this;
    }

    public function getJoinedOn(): ?\DateTimeInterface
    {
        return $this->joinedOn;
    }

    public function setJoinedOn(\DateTimeInterface $joinedOn): self
    {
        $this->joinedOn = $joinedOn;

        return $this;
    }
    /**
    *@ORM\PrePersist
    */
    public function setJoinedOnValue()
    {
        $this->joinedOn=new \DateTime();
    }


    public function getProfilPicture(): ?string
    {
        return $this->profilPicture;
    }

    public function setProfilPicture(?string $profilPicture): self
    {
        $this->profilPicture = $profilPicture;

        return $this;
    }

   

    /**
     * Get the value of profilPictureFile
     *
     * @return  File|null
     */ 
    public function getProfilPictureFile()
    {
        return $this->profilPictureFile;
    }

    /**
     * Set the value of profilPictureFile
     *
     * @param  File|null  $profilPictureFile
     *
     * @return  self
     */ 

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile|null $profilPictureFile
     */
    public function setProfilPictureFile(?File $profilPictureFile = null): void
    {
        $this->profilPictureFile = $profilPictureFile;

        if (null !== $profilPictureFile) 
        {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }


    /**
     * Get the value of age
     */ 
    public function getAge()
    {
        return $this->age;
    }

    /**
     * Set the value of age
     *
     * @return  self
     */ 
    public function setAge($age)
    {
        $this->age = $age;

        return $this;
    }

    /**
     * Get the value of height
     */ 
    public function getHeight()
    {
        return $this->height;
    }

    /**
     * Set the value of height
     *
     * @return  self
     */ 
    public function setHeight($height)
    {
        $this->height = $height;

        return $this;
    }

    /**
     * Get the value of weight
     */ 
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set the value of weight
     *
     * @return  self
     */ 
    public function setWeight($weight)
    {
        $this->weight = $weight;

        return $this;
    }
}
