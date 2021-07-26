<?php

namespace App\Entity;

use Serializable;
use DateTimeImmutable;
use App\Entity\UserCategory;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\ORM\Mapping\HasLifecycleCallbacks;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints\Image;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation\Uploadable;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Validator\Constraints\EnableAutoMapping;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 * @UniqueEntity(fields={"email"}, message="Il y a déjà un compte avec cet email.")
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
     * @Assert\Email(
     *     message = "'{{ value }}' n'est pas une adresse Email valide."
     * )
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
    private $profilePicture;

    /**
     * @Vich\UploadableField(mapping="picture", fileNameProperty="profilePicture")
     * @var File|null
     */
    private $profilePictureFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updatedAt;

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

    /**
     * @ORM\Column(type="string")
     *
     * @Assert\NotBlank()
     * @Assert\Regex(
     *  pattern="/[0-9]{10}/")
     * @Assert\Length(min=10, max=10)
     */
    private $numberPhone;

    public function __toString()
    {
        return $this->email;
    }
    
    public function __serialize(): array
    {
        return [
            'id'=> $this->id,
            'email'=> $this->email,
            'password'=> $this->password,
            'firstname'=> $this->firstname,
            'lastname'=> $this->lastname,
            'userCategory'=> $this->userCategory,
            'age'=> $this->age,
            'height'=> $this->height,
            'weight'=> $this->weight,
            // 'numberphone'=> $this->numberPhone,
            'profilPicture'=> $this->profilePicture,
        ];
    }

    public function __unserialize(array $serialized): User
    {
            $this->id = $serialized['id'];
            $this->email= $serialized['email'];
            $this->password= $serialized['password'];
            $this->firstname= $serialized['firstname'];
            $this->lastname= $serialized['lastname'];
            $this->userCategory= $serialized['userCategory'];
            $this->age= $serialized['age'];
            $this->height= $serialized['height'];
            $this->weight= $serialized['weight'];
            // $this->numberPhone= $serialized['numberPhone'];
            $this->profilePicture= $serialized['profilPicture'];

            return $this;
    }

    /** @see \Serializable::serialize() */
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


    public function getProfilePicture(): ?string
    {
        return $this->profilePicture;
    }

    public function setProfilePicture(?string $profilePicture): self
    {
        $this->profilePicture = $profilePicture;

        return $this;
    }

    public function getProfilePictureFile(): ?File
    {
        return $this->profilePictureFile;
    }


    public function setProfilePictureFile(?File $profilePicture = null)
    {
        $this->profilePictureFile = $profilePicture;

        if ($profilePicture) 
        {
            $this->updatedAt = new \DateTimeImmutable('now');
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

    
    /**
     * Get the value of updatedAt
     *
     * @return  \DateTime
     */ 
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    
    /**
     * @param  \DateTime  $updatedAt
     * @return  self
     */ 
    public function setUpdatedAt(\DateTime $updatedAt)
    {
        $this->updatedAt = $updatedAt;
        
        return $this;
    }


    public function getFullName()
    {
        return $this->getFirstName().' '.$this->getLastName();
    }

    public function getNumberPhone(): ?string
    {
        return $this->numberPhone;
    }

    public function setNumberPhone(String $numberPhone): self
    {
        $this->numberPhone = $numberPhone;

        return $this;
    }
}
