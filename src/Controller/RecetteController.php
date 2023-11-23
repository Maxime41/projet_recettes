<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Ingredients;
use App\Entity\Recette;
use App\Form\RecetteType;
use App\Repository\IngredientsRepository;
use App\Repository\RecetteRepository;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use DateTimeImmutable;
use Symfony\Config\TwigConfig;

class RecetteController extends AbstractController
{
    #[Route('/recette', name: 'app_recette')]
    public function index(RecetteRepository $repository): Response
    {
        $recettes =  $repository->findAll();
        return $this->render('recette/index.html.twig', [
            'controller_name' => 'RecetteController',
            'recettes' => $recettes,
        ]);
    }
    #[Route('/recette/ingredient', name: 'recette.ingredient')]
    public function recettes10(RecetteRepository $repository): Response
    {
        $recettes = $repository->find_10_recettes();
        return $this->render('recette/index.html.twig', [
            'recettes' => $recettes,
        ]);
    }
    #[Route('/recette/avec_5_ingredient', name: 'recette.ingredient5')]
    public function recettes_5_ingredient(RecetteRepository $repository): Response
    {
        $recettes = $repository->find_5_recettes_ingredient();
        return $this->render('recette/index.html.twig', [
            'recettes' => $recettes,
        ]);
    }
    #[Route('/recette/create_avec_3_ingredients','recette.create_avec3_ingredient',methods: ['GET', 'POST'])]
    public function recette_create_3_ingredients(Request $request, EntityManagerInterface $entity_manager): Response
    {  
        $recette = new Recette();

        
        $crea_form = $this->createForm(RecetteType::class, $recette, [ 'submit label' => 'Créer une recette avec 3 ingredients']);

        $crea_form->handleRequest($request);

        if($crea_form->isSubmitted() && $crea_form->isValid()) {
            $data = $crea_form->getData();
            // dd($data);
            // $recette->setNom($data->getNom());
            // $recette->setTemps($data->getTemps());
            // $recette->setPrix($data->getPrix());
            // $recette->setCreatedAt(new DateTimeImmutable());
            // $recette->setUpdatedAt(new DateTimeImmutable());
            // $recette->setDescription($data->getDescription());
            // $recette->setDifficulte($data->getDifficulte());
            // $recette->addIngredient($data->getIngredients());
    
            $entity_manager->persist($recette);
            $entity_manager->flush();

            $this->addFlash('success', 'Votre recette a bien été créé avec succès !');
            return $this->redirectToRoute('app_recette');
        }

        return $this->render('recette/create_3_ingredients.html.twig', [
            'crea_form' => $crea_form->createView(),
        ]);
    }
}
