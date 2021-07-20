<?php

namespace App\Entity;

use App\Entity\User;
use App\Entity\Difficulty;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\RecipePostRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Image;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;
use Vich\UploaderBundle\Mapping\Annotation\Uploadable;
use Symfony\Component\Validator\Constraints\EnableAutoMapping;

/**
 * @ORM\Entity(repositoryClass=RecipePostRepository::class)
 * @Vich\Uploadable
*@ORM\HasLifecycleCallbacks()
 */
class RecipePost
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titleR;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $recipe;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

     /**
     * @Vich\UploadableField(mapping="picture", fileNameProperty="picture")
     * @var File|null
     */
    private $pictureFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     * )
     */
    private $updated;

    /**
     * @ORM\Column(type="datetime")
     * 
     * @ORM\ManyToOne(targetEntity=UserCategory::class, inversedBy="articles")
     */
    private $createdAt;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $preparationTime;
    
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $ingredient;
    
    /**
     * @ORM\ManyToOne(targetEntity=UserCategory::class)
     * @ORM\JoinColumn(nullable=true)
     */
    private $userCategory;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $titleP;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @ORM\ManyToOne(targetEntity=Difficulty::class, inversedBy="recipePosts")
     */
    private $difficulty;
    
    
    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTime();
    } 

    public function __toString()
    {
        return $this->preparationTime;
    }
    
    public function __serialize(): array
    {
        return [
            'id'=> $this->id,
            'titleR'=> $this->titleR,
            'recipe'=> $this->recipe,
            'picture'=> $this->picture,
            
        ];
    }

    public function __unserialize(array $serialized): RecipePost
    {
            $this->id = $serialized['id'];
            $this->titleR= $serialized['titleR'];
            $this->recipe= $serialized['recipe'];
            $this->picture= $serialized['picture'];
            
            return $this;
    }
    public function getId(): ?int
    {
        return $this->id;
    }
    
    public function getTitleR(): ?string
    {
        return $this->titleR;
    }

    public function setTitleR(?string $titleR): self
    {
        $this->titleR = $titleR;

        return $this;
    }

    public function getRecipe(): ?string
    {
        return $this->recipe;
    }

    public function setRecipe(string $recipe): self
    {
        $this->recipe = $recipe;

        return $this;
    }

    public function getPicture(): ?string
    {
        return $this->picture;
    }

    public function setPicture(?string $picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * Get the value of pictureFile
     *
     * @return  File|null
     */ 
    public function getPictureFile(): ?File
    {
        return $this->pictureFile;
    }

    /**
     *
     * @param  File|null  $pictureFile
     * 
     */
    public function setPictureFile(?File $pictureFile = null): void
    {
        $this->pictureFile = $pictureFile;

        if (null !== $pictureFile) 
        {
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }


    public function getPreparationTime(): ?\DateTimeInterface
    {
        return $this->preparationTime;
    }

    public function setPreparationTime(?\DateTimeInterface $preparationTime): self
    {
        $this->preparationTime = $preparationTime;

        return $this;
    }

    public function getIngredient(): ?string
    {
        return $this->ingredient;
    }

    public function setIngredient(?string $ingredient): self
    {
        $this->ingredient = $ingredient;

        return $this;
    }

    /**
     * Get the value of updated
     *
     * @return  \DateTime
     */ 
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set the value of updated
     *
     * @param  \DateTime  $updated
     *
     * @return  self
     */ 
    public function setUpdated(\DateTime $updated)
    {
        $this->updated = $updated;

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

    public function getTitleP(): ?string
    {
        return $this->titleP;
    }

    public function setTitleP(?string $titleP): self
    {
        $this->titleP = $titleP;

        return $this;
    }

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

        return $this;
    }

    public function getDifficulty(): ?Difficulty
    {
        return $this->difficulty;
    }

    public function setDifficulty(?Difficulty $difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    public function getTitle()
    {
        return $this->getTitleR().' '.$this->getTitleP();
    }
    public function getContenu()
    {
        return $this->getRecipe().' '.$this->getContent();
    }
}
