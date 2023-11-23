<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\IngrédientsRepository;

class IngredientController extends AbstractController
{
    #[Route('/ingredient', name: 'app_ingredient')]
    public function index(IngrédientsRepository $repository): Response
    {
        $ingredients =  $repository->findAll();
        return $this->render('ingredient/index.html.twig', [
            'controller_name' => 'IngredientController',
            'ingrédients' => $ingredients,
        ]);
    }
}
