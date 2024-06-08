<?php

namespace App\Controller;

use App\Entity\CartItem;
use App\Entity\Shoe;
use App\Form\CartItemType;
use App\Repository\ShoeRepository;
use App\Service\CartService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

class ShoesController extends AbstractController
{
    #[Route('/shoes/{id}', name: 'app_shoes', requirements: ['id' => '\d+'], methods: ['GET', 'POST'])]
    public function index(?Shoe $shoe, Request $request, SessionInterface $session, CartService $cartService): Response
    {
        $cartItem = new CartItem();
        $cartItem->setShoe($shoe);

        $form = $this->createForm(CartItemType::class, $cartItem);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $cartService->addCart($form->getData());

            return $this->redirectToRoute('app_shoes', ['id' => $shoe->getId()]);
        }

        return $this->render('shoes/index.html.twig', [
            'controller_name' => 'ShoesController',
            'shoe' => $shoe,
            'form' => $form->createView(),
        ]);
    }
}
