<?php

namespace App\Entity;

use App\Repository\DifficultyRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DifficultyRepository::class)
 */
class Difficulty
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
    private $difficulty;

    /**
     * @ORM\OneToMany(targetEntity=RecipePost::class, mappedBy="difficulty")
     */
    private $recipePosts;

    public function __construct()
    {
        $this->recipePosts = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->difficulty;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDifficulty(): ?string
    {
        return $this->difficulty;
    }

    public function setDifficulty(string $difficulty): self
    {
        $this->difficulty = $difficulty;

        return $this;
    }

    /**
     * @return Collection|RecipePost[]
     */
    public function getRecipePosts(): Collection
    {
        return $this->recipePosts;
    }

    public function addRecipePost(RecipePost $recipePost): self
    {
        if (!$this->recipePosts->contains($recipePost)) {
            $this->recipePosts[] = $recipePost;
            $recipePost->setDifficulty($this);
        }

        return $this;
    }

    public function removeRecipePost(RecipePost $recipePost): self
    {
        if ($this->recipePosts->removeElement($recipePost)) {
            // set the owning side to null (unless already changed)
            if ($recipePost->getDifficulty() === $this) {
                $recipePost->setDifficulty(null);
            }
        }

        return $this;
    }
}
