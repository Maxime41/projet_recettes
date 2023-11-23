<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HelloController extends AbstractController
{
    #[Route('/hello_world', name: 'show_hello_world')]
    public function index(): Response
    {
        return $this->render('hello/hello_world.html.twig', [
            'controller_name' => 'HelloController',
        ]);
    }
}
