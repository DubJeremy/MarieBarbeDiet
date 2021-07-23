<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\BookingRepository;
use Symfony\Component\Form\FormTypeInterface;

/**
 * @ORM\Entity(repositoryClass=BookingRepository::class)
* @ORM\HasLifecycleCallbacks()
 */
class Booking
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;
    /**
     * @ORM\ManyToOne(targetEntity=User::class)
     * @ORM\JoinColumn(nullable=true)
     */
    private $author;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $backgroundColor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $borderColor;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $textColor;

    /**
     * @ORM\ManyToOne(targetEntity=BookingType::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $bookingType;

    /**
     * @ORM\ManyToOne(targetEntity=ApplicationChoice::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $applicationChoice;

    /**
     * @ORM\Column(type="datetime")
     */
    private $start;

    /**
     * @ORM\Column(type="datetime")
     */
    private $end;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $message;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAuthor(): ?User
    {
        return $this->author;
    }

    public function setAuthor(?User $author): self
    {
        $this->author = $author;

        return $this;
    }

    public function getBackgroundColor(): ?string
    {
        return $this->backgroundColor;
    }

    public function setBackgroundColor(string $backgroundColor): self
    {
        $this->backgroundColor = $backgroundColor;

        return $this;
    }

    public function getBorderColor(): ?string
    {
        return $this->borderColor;
    }

    public function setBorderColor(string $borderColor): self
    {
        $this->borderColor = $borderColor;

        return $this;
    }

    /**
     * @ORM\PrePersist
     *
     * @return self
     */
    public function setBorderColorValue(): self
    {
        $this->borderColor = "#000000";

        return $this;
    }

    public function getTextColor(): ?string
    {
        return $this->textColor;
    }

    public function setTextColor(string $textColor): self
    {
        $this->textColor = $textColor;

        return $this;
    }

    /**
     * @ORM\PrePersist
     *
     * @return self
     */
    public function setTextColorValue(): self
    {
        $this->textColor = "#000000";

        return $this;
    }

    public function getBookingType(): ?BookingType
    {
        return $this->bookingType;
    }

    public function setBookingType(?BookingType $bookingType): self
    {
        $this->bookingType = $bookingType;

        return $this;
    }

    public function getApplicationChoice(): ?ApplicationChoice
    {
        return $this->applicationChoice;
    }

    public function setApplicationChoice(?ApplicationChoice $applicationChoice): self
    {
        $this->applicationChoice = $applicationChoice;

        return $this;
    }

    public function getStart(): ?\DateTimeInterface
    {
        return $this->start;
    }

    public function setStart(\DateTimeInterface $start): self
    {
        $this->start = $start;

        return $this;
    }

    public function getEnd(): ?\DateTimeInterface
    {
        return $this->end;
    }

    public function setEnd(\DateTimeInterface $end): self
    {
        $this->end = $end;

        return $this;
    }

    public function getMessage(): ?string
    {
        return $this->message;
    }

    public function setMessage(?string $message): self
    {
        $this->message = $message;

        return $this;
    }
}
