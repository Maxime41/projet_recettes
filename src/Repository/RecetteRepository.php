<?php

namespace App\Repository;

use App\Entity\Recette;
use App\Entity\Ingredients;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Recette>
 *
 * @method Recette|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recette|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recette[]    findAll()
 * @method Recette[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecetteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recette::class);
    }

//    /**
//     * @return Recette[] Returns an array of Recette objects
//     */
    public function find_10_recettes(): array 
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
        'SELECT p
        FROM App\Entity\Recette p
        ORDER BY p.id ASC'

        )
        ->setMaxResults(10);
        return $query->getResult();
    }
    public function find_5_recettes_ingredient(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
        'SELECT r
        FROM App\Entity\Recette r
        WHERE SIZE(r.ingredients) = 5
        ORDER BY r.id ASC'
        );
        return $query->getResult();
    }
}
