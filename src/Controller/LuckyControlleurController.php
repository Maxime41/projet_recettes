<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class LuckyControlleurController extends AbstractController
{
    #[Route('/lucky/controlleur', name: 'app_lucky_controlleur')]
    public function index(): Response
    {
        return $this->render('lucky_controlleur/index.html.twig', [
            'controller_name' => 'LuckyControlleurController',
        ]);
    }
    #[Route('/lucky/number', name: 'app_lucky_number')]
    public function show_number(): Response
    {
        $number = random_int(0, 100);
        return new Response('Nombre tiré au sort : ' . $number);
    }
    #[Route('/lucky/number_for_username', name: 'app_lucky_number_v2')]
    public function show_number_v2(Request $request): Response
    {
        $number = random_int(0, 100);
        return new Response('Nombre tiré au sort : ' . $number . ' pour ' . $request->query->get('username'));
    }
    #[Route('lucky/number_v3', name:'app_lucky_number_v3')]
    public function show_number_v3(Request $request): Response
    {
        $tab = array();
        for ($i =0; $i <10; $i++) {
            
            $numbers[] = random_int(0, 100);
           
        }
        // dd($number);
        return $this->render('lucky_controlleur/number.html.twig',[
            'numbers' => $numbers,
        ]);
    }
}
