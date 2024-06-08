<?php

namespace App\Controller;

use App\Repository\ShoeRepository;
use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(ShoeRepository $repository, CartService $cartService): Response
    {
        $cart = $cartService->getCart();
        $shoes = [];
        foreach ($cart as $key => &$item) {
            $shoes[$key] = $repository->find($key);
        }

        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
            'cart' => $cart,
            'shoes' => $shoes,
            'total' => $cartService->getTotal($repository),
        ]);
    }

    #[Route('/cart/{shoeId}/{waist}', name: 'app_cart_remove', methods: ['POST'])]
    public function removeFormCart(int $shoeId, int $waist, CartService $cartService): Response
    {
        $cartService->removeCart($shoeId, $waist);

        return $this->redirectToRoute('app_cart');
    }

}
