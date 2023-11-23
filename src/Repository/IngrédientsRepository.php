<?php

namespace App\Repository;

use App\Entity\Ingrédients;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Ingrédients>
 *
 * @method Ingrédients|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ingrédients|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ingrédients[]    findAll()
 * @method Ingrédients[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IngrédientsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ingrédients::class);
    }

//    /**
//     * @return Ingrédients[] Returns an array of Ingrédients objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('i.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Ingrédients
//    {
//        return $this->createQueryBuilder('i')
//            ->andWhere('i.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
