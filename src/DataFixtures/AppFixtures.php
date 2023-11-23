<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Ingredients;
use App\Entity\Recette;
use App\Entity\User;
use Faker\Factory;
use App\Repository\IngredientRepository;
use App\Repository\RecetteRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use DateTimeImmutable;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    public function load(ObjectManager $manager): void
    {
        $faker_factory = Factory::create('fr_FR');
        // $product = new Product();
        // $manager->persist($product);
        for ($i = 0; $i < 100; $i++) {
            $ingredient[$i] = new Ingredients();
            $ingredient[$i]->setNom("ingr_" . $faker_factory->word());
            $ingredient[$i]->setPrix($faker_factory->randomFloat(2, 0, 200));
            $ingredient[$i]->setDateCreation(new DateTimeImmutable());
            $ingredient[$i]->setUpdatedAt(new DateTimeImmutable());
            $ingredient[$i]->setSlug("test slug");
            $manager->persist($ingredient[$i]);
        }

        for ($i = 0; $i < 50; $i++) {
            $recette = new Recette();
            $recette->setTemps(10);
            $recette->setNom("Recette". $faker_factory->word());
            $recette->setPrix($faker_factory->randomFloat(1,0, 200));
            $recette->setDescription("a");
            $recette->setDifficulte($faker_factory->numberBetween(0, 5));
            $recette->setCreatedAt(new DateTimeImmutable());
            $recette->setUpdatedAt(new DateTimeImmutable());

            $nb_ingredient = rand(2,10);
            for($k = 0; $k<$nb_ingredient;$k++){
                $recette->addIngredient($ingredient[rand(0,99)]);
            }

            $manager->persist($recette);
            $manager->flush();
        }
        //Création de 20 users
        for ($i = 0; $i < 20; $i++) {
            $user = new User();
            $user->setEmail($faker_factory->email());
            $password = $this->hasher->hashPassword($user, '1234');
            $user->setPassword($password);
            $user->setPassword($password);
            $user->setNom($faker_factory->lastName());
            $user->setPrenom($faker_factory->firstName());
            $user->setVille($faker_factory->city());
            $user->setCp($faker_factory->postcode());
            $user->setRoles(["ROLE_USER"]);

            $manager->persist($user);
            $manager->flush();
        }
        //  Création de l'user admin
        $admin = new User();
        $admin->setEmail("admin@a.com");
        $password = $this->hasher->hashPassword($admin, '1234');
        $admin->setPassword($password);
        $admin->setNom($faker_factory->lastName());
        $admin->setPrenom($faker_factory->firstName());
        $admin->setVille($faker_factory->city());
        $admin->setCp($faker_factory->postcode());
        $admin->setRoles(["ROLE_ADMIN"]);

        $manager->persist($admin);
        $manager->flush();
    }
}
