<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Ingrédients;
use Faker\Factory;
use DateTimeImmutable;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker_factory = Factory::create('fr_FR');
        // $product = new Product();
        // $manager->persist($product);
        for ($i = 0; $i < 20; $i++) {
            $ingredient = new Ingrédients();
            $ingredient->setNom($faker_factory->word());
            $ingredient->setPrix($faker_factory->randomFloat(2, 0, 200));
            $ingredient->setDateCreation(new DateTimeImmutable());
            $manager->persist($ingredient);
        }

        $manager->flush();
    }
}
