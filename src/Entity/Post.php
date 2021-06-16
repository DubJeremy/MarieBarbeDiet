<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */
class Post
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
     * @ORM\Column(type="text", nullable=true)
     */
    private $content;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $picture;

    /**
     * @ORM\Column(type="datetime")
     */
    private $cretedAt;

    /**
     * @ORM\ManyToMany(targetEntity=UserCategory::class)
     */
    private $userCategory;

    public function __construct()
    {
        $this->userCategory = new ArrayCollection();
    }

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

    public function getContent(): ?string
    {
        return $this->content;
    }

    public function setContent(?string $content): self
    {
        $this->content = $content;

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

    public function getCretedAt(): ?\DateTimeInterface
    {
        return $this->cretedAt;
    }

    public function setCretedAt(\DateTimeInterface $cretedAt): self
    {
        $this->cretedAt = $cretedAt;

        return $this;
    }

    /**
     * @return Collection|UserCategory[]
     */
    public function getUserCategory(): Collection
    {
        return $this->userCategory;
    }

    public function addUserCategory(UserCategory $userCategory): self
    {
        if (!$this->userCategory->contains($userCategory)) {
            $this->userCategory[] = $userCategory;
        }

        return $this;
    }

    public function removeUserCategory(UserCategory $userCategory): self
    {
        $this->userCategory->removeElement($userCategory);

        return $this;
    }
}
