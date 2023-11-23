<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Taxe\CalculatorTaxe;

class HelloController extends AbstractController
{
    #[Route('/hello', name: 'show_hello')]
    public function index_taxe(CalculatorTaxe $taxe): Response
    {
        $prixHT = 360;
        $TTC = $taxe->calculerTTC($prixHT);
        $TVA = $taxe->calculerTVA($prixHT);
        return $this->render('hello/hello_world.html.twig', [
            'controller_name' => 'HelloController',
            'prixHT' => $prixHT,
            'TTC' => $TTC,
            'TVA' => $TVA,
        ]);
    }
}
