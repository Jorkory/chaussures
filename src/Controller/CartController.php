<?php

namespace App\Controller;

use App\Repository\ShoeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(SessionInterface $session, ShoeRepository $repository): Response
    {
        $cart = $session->get('cart', []);
        $shoes = [];
        foreach ($cart as $key => &$item) {
            $shoes[$key] = $repository->find($key);
        }

        return $this->render('cart/index.html.twig', [
            'controller_name' => 'CartController',
            'cart' => $cart,
            'shoes' => $shoes,
        ]);
    }
}
