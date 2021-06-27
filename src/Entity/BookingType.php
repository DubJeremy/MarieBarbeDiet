<?php

namespace App\Entity;

use App\Repository\BookingTypeRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=BookingTypeRepository::class)
 */
class BookingType
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
    private $bookingType;

    public function __toString()
    {
        return $this->bookingType;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBookingType(): ?string
    {
        return $this->bookingType;
    }

    public function setBookingType(string $bookingType): self
    {
        $this->bookingType = $bookingType;

        return $this;
    }
}
