<?php

namespace App\Entity;

use App\Repository\UserCategoryRepository;
use Doctrine\ORM\Mapping as ORM;

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
}
