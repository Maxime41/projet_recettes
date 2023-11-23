<?php
namespace App\EventListener;

use App\Entity\Ingredients;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Events;

use App\Entity\Conference;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\String\Slugger\SluggerInterface;

#[AsEntityListener(event: Events::preUpdate, method: 'preUpdate', entity: Ingredients::class)]
#[AsEntityListener(event: Events::prePersist, method: 'prePersist', entity: Ingredients::class)]
class IngredientListener
{

    public function __construct(private SluggerInterface $slugger)
    {

    }
    // the entity listener methods receive two arguments:
    // the entity instance and the lifecycle event
    public function PreUpdate(Ingredients $ingredient, PreUpdateEventArgs $event): void
    {
        // ... do something to notify the changes

        $ingredient->setUpdatedAt(new \DateTimeImmutable());
        
        // Slug
        $ingredient->setSlug($this->slugger->slug($ingredient->getNom()));
    }

    public function prePersist(Ingredients $ingredient, LifecycleEventArgs $event)
    {
        $ingredient->setSlug($this->slugger->slug($ingredient->getNom()));
    }
}