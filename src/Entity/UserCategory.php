<?php

namespace App\Entity;

use App\Entity\Recipe;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserCategoryRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity(repositoryClass=UserCategoryRepository::class)
 */
class UserCategory
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
    private $userCategory;

    /**
     * @ORM\OneToMany(targetEntity=RecipePost::class, mappedBy="userCategory")
     * @ORM\OrderBy({"createdAt" = "DESC"})
     */
    private $recipePost;

    public function __toString()
    {
        return $this->userCategory;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUserCategory(): ?string
    {
        return $this->userCategory;
    }
    
    public function setUserCategory(string $userCategory): self
    {
        $this->userCategory = $userCategory;

        return $this;
    }

    /**
     * @return Collection|recipePost[]
     */
    public function getRecipePost(): Collection
    {
        return $this->recipe;
    }

}
