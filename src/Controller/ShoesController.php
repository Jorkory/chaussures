<?php

namespace App\Controller;

use App\Entity\Shoe;
use App\Repository\ShoeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ShoesController extends AbstractController
{
    #[Route('/shoes/{id}', name: 'app_shoes', requirements: ['id' => '\d+'], methods: ['GET'])]
    public function index(?Shoe $shoe): Response
    {
        return $this->render('shoes/index.html.twig', [
            'controller_name' => 'ShoesController',
            'shoe' => $shoe,
        ]);
    }
}
