<?php

namespace App\Entity;

use PHPUnit\Framework\Assert;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PostRepository;
use Doctrine\Common\Collections\Collection;
use Symfony\Component\HttpFoundation\File\File;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Image;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use PHPUnit\Framework\Assert\EnableAutoMapping;

/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 * @Vich\Uploadable
 * @ORM\Entity(repositoryClass=PostRepository::class)
 *@ORM\HasLifecycleCallbacks()
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
     * @Vich\UploadableField(mapping="picture", fileNameProperty="picture")
     * 
     * @var File|null
     * @Assert\Image(
     *     maxPixels = 1920,
     * )
     */
    private $pictureFile;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     * @var \DateTime
     */
    private $updated;

    /**
     * @ORM\Column(type="datetime")
     */
    private $createdAt;

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

    /**
     * Get the value of pictureFile
     *
     * @return  File|null
     */ 
    public function getPictureFile(): ?File
    {
        return $this->pictureFile;
    }

    public function setPictureFile($picture = null)
    {
        $this->pictureFile = $picture;

        if ($picture) 
        {
            $this->updatedAt = new \DateTime('now');
        }
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->createdAt;
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->creteadAt = $createdAt;

        return $this;
    }

    /**
     * @ORM\PrePersist
     */
    public function setCreatedAtValue()
    {
        $this->createdAt = new \DateTime();
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
