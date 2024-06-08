<?php

namespace App\Controller;

use App\Entity\CartItem;
use App\Entity\Shoe;
use App\Form\CartItemType;
use App\Repository\ShoeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

class ShoesController extends AbstractController
{
    #[Route('/shoes/{id}', name: 'app_shoes', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function index(?Shoe $shoe, Request $request, SessionInterface $session): Response
    {
        $cartItem = new CartItem();
        $cartItem->setShoe($shoe);

        $form = $this->createForm(CartItemType::class, $cartItem);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $cart = $session->get('cart', []);
            $shoeId = $shoe->getId();

            if (!isset($cart[$shoeId]) || !isset($cart[$shoeId][$cartItem->getWaist()])) {
                $cart[$shoeId][$cartItem->getWaist()] = [
                    'quantity' => 0,
                ];
            }

            $cart[$shoeId][$cartItem->getWaist()]['quantity'] += $cartItem->getQuantity();
            $session->set('cart', $cart);
            dd($session->get('cart'));
            return $this->redirectToRoute('app_shoes', ['id' => $shoe->getId()]);
        }

        return $this->render('shoes/index.html.twig', [
            'controller_name' => 'ShoesController',
            'shoe' => $shoe,
            'form' => $form->createView(),
        ]);
    }
}
