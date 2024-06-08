<?php

namespace App\Controller;

use App\Repository\ShoeRepository;
use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;

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
    public function removeFormCart(int $shoeId, int $waist, CartService $cartService,Request $request, CsrfTokenManagerInterface $csrfTokenManager): Response
    {
        $token = $request->request->get('_token');
        if($csrfTokenManager->isTokenValid(new CsrfToken('remove_item', $token))) {
            $cartService->removeCart($shoeId, $waist);
        }

        return $this->redirectToRoute('app_cart');
    }

}
