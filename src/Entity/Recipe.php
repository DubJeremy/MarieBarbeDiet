<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\RecipeRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Image;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Vich\UploaderBundle\Mapping\Annotation\Uploadable;
use PHPUnit\Framework\Assert\EnableAutoMapping;

/**
 * @ORM\Entity(repositoryClass=RecipeRepository::class)
 * @Vich\Uploadable
*@ORM\HasLifecycleCallbacks()
 */
class Recipe
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
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $recipe;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

     /**
     * @Vich\UploadableField(mapping="picture", fileNameProperty="picture")
     * 
     * @var File|null
     */
    private $pictureFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     * @Assert\Image(
     *     maxPixels = 1920,
     * )
     */
    private $updated;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTime();
    }

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $preparationTime;

    /**
     * @ORM\ManyToOne(targetEntity=Difficulty::class)
     */
    private $difficulty;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $ingredient;

    /**
     * @ORM\ManyToOne(targetEntity=UserCategory::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $userCategory;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): self
    {
        $this->title = $title;

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

    public function getDifficulty(): ?Difficulty
    {
        return $this->difficulty;
    }

    public function setDifficulty(?Difficulty $difficulty): self
    {
        $this->difficulty = $difficulty;

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
}
