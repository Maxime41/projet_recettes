<?php

namespace App\Repository;

use App\Entity\Recette1;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Recette1>
 *
 * @method Recette1|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recette1|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recette1[]    findAll()
 * @method Recette1[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class Recette1Repository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Recette1::class);
    }

//    /**
//     * @return Recette1[] Returns an array of Recette1 objects
//     */
//    public function findByExampleField($value): array
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->orderBy('r.id', 'ASC')
//            ->setMaxResults(10)
//            ->getQuery()
//            ->getResult()
//        ;
//    }

//    public function findOneBySomeField($value): ?Recette1
//    {
//        return $this->createQueryBuilder('r')
//            ->andWhere('r.exampleField = :val')
//            ->setParameter('val', $value)
//            ->getQuery()
//            ->getOneOrNullResult()
//        ;
//    }
}
