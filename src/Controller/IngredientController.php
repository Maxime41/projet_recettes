<?php

namespace App\Controller;

use App\Entity\Ingredients;
use App\Form\IngredientType;
use App\Form\IngredientType_v3;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\IngredientsRepository;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use DateTimeImmutable;
use Symfony\Config\TwigConfig;
use Psr\Log\LoggerInterface;

class IngredientController extends AbstractController
{
    #[Route('/ingredient', name: 'app_ingredient')]
    public function index(IngredientsRepository $repository, LoggerInterface $loggerinterface): Response
    {
        $ingredients =  $repository->findAll();
        $loggerinterface->info('AFFICHAGE DE TOUS LES INGREDIENTS');
        return $this->render('ingredient/index.html.twig', [
            'controller_name' => 'IngredientController',
            'ingredients' => $ingredients,
        ]);
    }
    #[Route('/ingredient/greater_than_100', name: 'app_ingredient_greater_than_100')]
    public function index_only_greater_than_100(IngredientsRepository $repository): Response
    {
        $ingredients = $repository->findAllGreaterThanPrice(100);
        return $this->render('ingredient/index.html.twig', [
            'ingredients' => $ingredients,
        ]);
    }
    #[Route('/ingredient/tomate', name: 'ingredient.tomate')]
    public function index_ingredient_tomate(LoggerInterface $loggerinterface, IngredientsRepository $repository): Response
    {
        $ingredients = $repository->find_ingredient_tomate();
        $loggerinterface->error('APPEL DE find_ingredient_tom');
        return $this->render('ingredient/index.html.twig', [
            'ingredients' => $ingredients,
        ]);
    }
    #[Route('/ingredient/tomate_5', name: 'ingredient.tomate_5')]
    public function index_ingredient_tomate_5(IngredientsRepository $repository): Response
    {
        $ingredients = $repository->find_ingredient_tomate_5();
        return $this->render('ingredient/index.html.twig', [
            'ingredients' => $ingredients,
        ]);
    }
    #[Route('/ingredient/tom', name: 'ingredient.tom')]
    public function index_ingredient_tom(IngredientsRepository $repository): Response
    {
        $ingredients = $repository->find_ingredient_tom5();
        return $this->render('ingredient/index.html.twig', [
            'ingredients' => $ingredients,
        ]);
    }
    #[Route('/ingredient/by_price/{price}', name: 'ingredient.by_price')]
    public function index_ingredient_by_price(IngredientsRepository $repository, float $price): Response
    {
        $ingredients = $repository->find_ingredient_by_price($price);
        return $this->render('ingredient/index.html.twig', [
            'ingredients' => $ingredients,
        ]);
    }
    #[Route('/ingredient/by_price/{price}/by_name/{name}', name: 'ingredient.by_price_and_name')]
    public function index_ingredient_by_price_and_name(IngredientsRepository $repository, float $price, string $name): Response
    {
        $ingredients = $repository->find_ingredient_by_price_and_name($price, $name);
        return $this->render('ingredient/index.html.twig', [
            'ingredients' => $ingredients,
        ]);
    }
    #[Route('/ingredient_sql', name: 'ingredientsql')]
    public function index_sql(IngredientsRepository $repository): Response
    {
        $ingredients = $repository->findAll_sql();
        return $this->render('ingredient/index.html.twig', [
            'controller_name' => 'IngredientController',
            'ingredients' => $ingredients,
        ]);
    }
    #[Route('/ingredient/tomate_5_sql', name: 'ingredient.tomate_5_sql')]
    public function index_ingredient_tomate_5_sql(IngredientsRepository $repository): Response
    {
        $ingredients = $repository->find_ingredient_tomate_5_sql();
        return $this->render('ingredient/index.html.twig', [
            'ingredients' => $ingredients,
        ]);
    }
    #[Route('/ingredient/tomate_sql', name: 'ingredient.tomatesql')]
    public function index_ingredient_tomate_sql(IngredientsRepository $repository): Response
    {
        $ingredients = $repository->find_ingredient_tomate_sql();
        return $this->render('ingredient/index.html.twig', [
            'ingredients' => $ingredients,
        ]);
    }
    #[Route('/ingredient/tom_sql', name: 'ingredient.tomsql')]
    public function index_ingredient_tom_sql(IngredientsRepository $repository): Response
    {
        $ingredients = $repository->find_ingredient_tom_sql();
        return $this->render('ingredient/index.html.twig', [
            'ingredients' => $ingredients,
        ]);
    }
    #[Route('/ingredient/by_price/{price}/sql', name: 'ingredient.by_pricesql')]
    public function index_ingredient_by_price_sql(IngredientsRepository $repository, float $price): Response
    {
        $ingredients = $repository->find_ingredient_by_price_sql($price);
        return $this->render('ingredient/index.html.twig', [
            'ingredients' => $ingredients,
        ]);
    }
    #[Route('/ingredient/by_price/{price}/by_name/{name}/sql', name: 'ingredient.by_price_and_namesql')]
    public function index_ingredient_by_price_and_name_sql(IngredientsRepository $repository, float $price, string $name): Response
    {
        $ingredients = $repository->find_ingredient_by_price_and_name_sql($price, $name);
        return $this->render('ingredient/index.html.twig', [
            'ingredients' => $ingredients,
        ]);
    }
    #[Route('/ingredient_dql', name: 'ingredientdql')]
    public function index_dql(IngredientsRepository $repository): Response
    {
        $ingredients = $repository->findAll_dql();
        return $this->render('ingredient/index.html.twig', [
            'controller_name' => 'IngredientController',
            'ingredients' => $ingredients,
        ]);
    }
    #[Route('/ingredient/tomate_dql', name: 'ingredient.tomate_dql')]
    public function index_ingredient_tomate_dql(IngredientsRepository $repository): Response
    {
        $ingredients = $repository->find_ingredient_tomate_dql();
        return $this->render('ingredient/index.html.twig', [
            'ingredients' => $ingredients,
        ]);
    }
    #[Route('/ingredient/tomate_5_dql', name: 'ingredient.tomate_5_dql')]
    public function index_ingredient_tomate_5_dql(IngredientsRepository $repository): Response
    {
        $ingredients = $repository->find_ingredient_tomate_5_dql();
        return $this->render('ingredient/index.html.twig', [
            'ingredients' => $ingredients,
        ]);
    }
    #[Route('/ingredient/tom_dql', name: 'ingredient.tomdql')]
    public function index_ingredient_tom_dql(IngredientsRepository $repository): Response
    {
        $ingredients = $repository->find_ingredient_tom_dql();
        return $this->render('ingredient/index.html.twig', [
            'ingredients' => $ingredients,
        ]);
    }
    #[Route('/ingredient/by_price/{price}/dql', name: 'ingredient.by_pricedql')]
    public function index_ingredient_by_price_dql(IngredientsRepository $repository, float $price): Response
    {
        $ingredients = $repository->find_ingredient_by_price_dql($price);
        return $this->render('ingredient/index.html.twig', [
            'ingredients' => $ingredients,
        ]);
    }
    #[Route('/ingredient/by_price/{price}/by_name/{name}/dql', name: 'ingredient.by_price_and_namedql')]
    public function index_ingredient_by_price_and_name_dql(IngredientsRepository $repository, float $price, string $name): Response
    {
        $ingredients = $repository->find_ingredient_by_price_and_name_dql($price, $name);
        return $this->render('ingredient/index.html.twig', [
            'ingredients' => $ingredients,
        ]);
    }
    #[Route('/ingredient/create', 'ingredient.create', methods: ['GET'])]
    public function create(Request $request): Response
    {
        $ingredient= new Ingredients();
        $crea_form = $this->createFormBuilder()
            ->add('nom', TextType::class, [

                'attr' => ['placeholder' => 'poivre']
            ])
            ->add('prix', NumberType::class, [

                'attr' => ['placeholder' => '10']
            ])
            ->add('save', SubmitType::class, ['label' => 'Creer un ingredient'])
            ->setAction($this->generateURL('ingredient.store'))
            ->setMethod('POST')
            ->getForm();
            
        return $this->render('ingredient/create.html.twig', [
            'crea_form' => $crea_form->createView(),
        ]);
    }
    #[Route('/ingredient/store','ingredient.store', methods: ['POST'])]
    public function store(Request $request, EntityManagerInterface $entity_manager): Response
    {
        $ingredient = new Ingredients();
        $data = $request->request->all();
        $ingredient->setNom($data["form"]["nom"]);
        $ingredient->setPrix($data["form"]["prix"]);
        $ingredient->setDateCreation(new DateTimeImmutable());

        $entity_manager->persist($ingredient);
        $entity_manager->flush();
        return $this->redirectToRoute('app_ingredient');
    }
    #[Route('/ingredient/create_and_store','ingredient.create_and_store',methods: ['GET', 'POST'])]
    public function create_and_store(Request $request, EntityManagerInterface $entity_manager): Response
    {  
        $ingredient = new Ingredients();

        // dd($this);
        $crea_form = $this->createFormBuilder()
            ->add('nom', TextType::class, [

                'attr' => ['placeholder' => 'poivre']
            ])
            ->add('prix', NumberType::class, [

                'attr' => ['placeholder' => '10']
            ])
            ->add('save', SubmitType::class, ['label' => 'Creer un ingredient'])
            ->getForm();

        $crea_form->handleRequest($request);

        if($crea_form->isSubmitted() && $crea_form->isValid()) {
            $data = $crea_form->getData();
            $ingredient->setNom($data["nom"]);
            $ingredient->setPrix($data["prix"]);
            $ingredient->setDateCreation(new DateTimeImmutable());
    
            $entity_manager->persist($ingredient);
            $entity_manager->flush();

            return $this->redirectToRoute('app_ingredient');
        }

        return $this->render('ingredient/create.html.twig', [
            'crea_form' => $crea_form->createView()
        ]);
    }
    #[Route('/ingredient/create_and_store_v2','ingredient.create_and_store_v2',methods: ['GET', 'POST'])]
    public function create_and_store_v2(Request $request, EntityManagerInterface $entity_manager): Response
    {  
        $ingredient = new Ingredients();

        
        $crea_form = $this->createForm(IngredientType::class, $ingredient);

        $crea_form->handleRequest($request);

        if($crea_form->isSubmitted() && $crea_form->isValid()) {
            $data = $crea_form->getData();
            $ingredient->setNom($data->getNom());
            $ingredient->setPrix($data->getPrix());
            $ingredient->setDateCreation(new DateTimeImmutable());
    
            $entity_manager->persist($ingredient);
            $entity_manager->flush();

            $this->addFlash('success', 'Votre ingrédient a bien été créé avec succès !');
            return $this->redirectToRoute('app_ingredient');
        }

        return $this->render('ingredient/create_v2.html.twig', [
            'crea_form' => $crea_form->createView(),
        ]);
    }
    #[Route('/ingredient/create_and_store_v3','ingredient.create_and_store_v3',methods: ['GET', 'POST'])]
    public function create_and_store_v3(Request $request, EntityManagerInterface $entity_manager, LoggerInterface $loggerinterface): Response
    {  
        $ingredient = new Ingredients();

        
        $crea_form = $this->createForm(IngredientType_v3::class, $ingredient, [ 'submit label' => 'Créer l\'ingrédient']);

        $crea_form->handleRequest($request);

        if($crea_form->isSubmitted() && $crea_form->isValid()) {
            $data = $crea_form->getData();
            $ingredient->setNom($data->getNom());
            $ingredient->setPrix($data->getPrix());
            $ingredient->setDateCreation(new DateTimeImmutable());
    
            $entity_manager->persist($ingredient);
            $entity_manager->flush();
            
            $loggerinterface->info('CREATION D\'UN NOUVEL INGREDIENT');
            $this->addFlash('success', 'Votre ingrédient a bien été créé avec succès !');
            return $this->redirectToRoute('app_ingredient');
        }

        return $this->render('ingredient/create_v3.html.twig', [
            'crea_form' => $crea_form->createView(),
        ]);
    }
    #[Route('/ingredient/edit/{id}','ingredient.edit', methods: ['GET','PUT'])]
    public function edit(Request $request, int $id, IngredientsRepository $repository, EntityManagerInterface $entity_manager): Response
    {
        $ingredient = $repository->findOneBy(['id' => $id]);

        $form = $this->createForm(IngredientType_v3::class, $ingredient, ['method' => 'PUT', 'submit label' => 'Enregistrer les modifications']);
        
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
    
            $entity_manager->persist($ingredient);
            $entity_manager->flush();

            $this->addFlash('success', 'Votre ingrédient a bien été modifié avec succès !');
            return $this->redirectToRoute('app_ingredient');
        }

        return $this->render('ingredient/create_v3.html.twig', [
            'crea_form' => $form->createView(),
        ]);
    }
    #[Route('/ingredient/by_slug/{slug}','ingredient.slug')]
    public function show_by_slug(Request $request, string $slug, IngredientsRepository $repository, EntityManagerInterface $entity_manager): Response
    {
        $ingredient = $repository->find_by_slug($slug);

        return $this->render('ingredient/show.html.twig', [
            'ingredients' => $ingredient,
        ]);
    }
    #[Route('/ingredient/delete/{id}','ingredient.delete', methods:['DELETE'])]
    public function delete(Request $request, int $id, IngredientsRepository $repository, EntityManagerInterface $entity_manager): Response
    {
        $ingredient = $repository->findOneBy(['id' => $id]);
        
        $entity_manager->remove($ingredient);
        $entity_manager->flush();

        $this->addFlash('success', 'Votre ingrédient a été supprimé avec succès !');
        return $this->redirectToRoute('app_ingredient');
    }
}
