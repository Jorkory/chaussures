<?php

namespace App\Service;

use App\Entity\CartItem;
use App\Repository\ShoeRepository;
use Symfony\Component\HttpFoundation\RequestStack;

class CartService
{
    private $cart;

    public function __construct(private RequestStack $stack)
    {
        $this->cart = $this->stack->getSession()->get('cart', []);
    }

    private function save(): void
    {
        $this->stack->getSession()->set('cart', $this->cart);
    }

    public function getCart(): array
    {
        return $this->cart;
    }

    public function getCartItemsCount(): int
    {
        $count = 0;
        foreach ($this->cart as $item) {
            foreach ($item as $waist) {
                $count += $waist['quantity'];
            }
        }
        return $count;
    }

    public function getTotal(ShoeRepository $repository): float
    {
        $total = 0;
        foreach ($this->cart as $key => $item) {
            $price = $repository->find($key)->getPrice();
            foreach ($item as $waist) {
                $total += $waist['quantity'] * $price;
            }
        }
        return $total;
    }

    public function addCart(CartItem $cartItem): void
    {
        $id = $cartItem->getShoe()->getId();
        $waist = $cartItem->getWaist();
        $quantity = $cartItem->getQuantity();

        if (!isset($this->cart[$id]) || !isset($this->cart[$id][$waist])) {
            $this->cart[$id][$waist] = [
                'quantity' => 0,
            ];
        }
        $this->cart[$id][$waist]['quantity'] += $quantity;

        $this->save();
    }

    public function removeCart(int $ShoeId, int $waist): void
    {
        if (isset($this->cart[$ShoeId][$waist])) {
            unset($this->cart[$ShoeId][$waist]);

            if (empty($this->cart[$ShoeId])) {
                unset($this->cart[$ShoeId]);
            }

            $this->save();
        }
    }

}