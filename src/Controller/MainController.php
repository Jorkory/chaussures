<?php

namespace App\Controller;

use App\Enum\ShoeCategory;
use App\Repository\ShoeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/{category}', name: 'app_main', defaults: ['category' => null])]
    public function index(Request $request, ShoeRepository $repository, ?ShoeCategory $category): Response
    {
        if($category) {
            $shoes = $repository->findAllByCategory($category);
        } else {
            $shoes = $repository->findAll();
        }

        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'shoes' => $shoes,
        ]);
    }
}
