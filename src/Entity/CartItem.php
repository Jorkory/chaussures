<?php

namespace App\Entity;

use App\Repository\CartItemRepository;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: CartItemRepository::class)]
class CartItem
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private int $quantity = 1;

    #[ORM\ManyToOne(inversedBy: 'cartItems')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Shoe $shoe = null;

    #[ORM\Column]
    private ?int $waist = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantity(): ?int
    {
        return $this->quantity;
    }

    public function setQuantity(int $quantity): static
    {
        $this->quantity = $quantity;

        return $this;
    }

    public function getShoe(): ?Shoe
    {
        return $this->shoe;
    }

    public function setShoe(?Shoe $shoe): static
    {
        $this->shoe = $shoe;

        return $this;
    }

    public function getWaist(): ?int
    {
        return $this->waist;
    }

    public function setWaist(int $waist): static
    {
        $this->waist = $waist;

        return $this;
    }
}
