<?php

namespace App\Repository;

use App\Entity\Ingredients;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Psr\Log\LoggerInterface;

/**
 * @extends ServiceEntityRepository<Ingredients>
 *
 * @method Ingredients|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ingredients|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ingredients[]    findAll()
 * @method Ingredients[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IngredientsRepository extends ServiceEntityRepository
{
    private LoggerInterface $loggerinterface;
    public function __construct(LoggerInterface $loggerinterface, ManagerRegistry $registry)
    {
        parent::__construct($registry, Ingredients::class);
        $this->loggerinterface = $loggerinterface;
    }

    //    /**
    //     * @return Ingredients[] Returns an array of Ingredients objects
    //     */
    public function findAllGreaterThanPrice(int $price): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
        'SELECT p
        FROM App\Entity\Ingredients p
        LIMIT 10
        WHERE p.prix > :price
        ORDER BY p.prix ASC'
        )->setParameter('price', $price);

        return $query->getResult();
    }
    public function find_ingredient_tomate(): array
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.nom = :valeur')
            ->setParameter('valeur', 'tomate')
            ->orderBy('i.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    public function find_ingredient_tomate_5(): array
    {
        return $this->createQueryBuilder('i')
            ->where('i.prix >= :price')
            ->andWhere('i.nom = :valeur')
            ->setParameter('valeur', 'tomate')
            ->setParameter('price', 5 )
            ->orderBy('i.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    public function find_ingredient_tom5(): array
    {
        return $this->createQueryBuilder('i')
            ->where('i.prix >= :price')
            ->andWhere('i.nom LIKE :valeur')
            ->setParameter('valeur', 'tomate%')
            ->setParameter('price', 5 )
            ->orderBy('i.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    public function find_ingredient_by_price(float $price): array
    {
        return $this->createQueryBuilder('i')
            ->where('i.prix = :price')
            ->setParameter('price', $price )
            ->orderBy('i.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    public function find_ingredient_by_price_and_name(float $price, string $name): array
    {
        return $this->createQueryBuilder('i')
            ->where('i.prix = :price')
            ->andWhere('i.nom = :valeur')
            ->setParameter('price', $price)
            ->setParameter('valeur', $name)
            ->orderBy('i.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    //Avec SQL
    public function findAll_sql(): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql=
        'SELECT * FROM ingredients';

        $resultat = $conn->executeQuery($sql);
        
        return $resultat->fetchAllAssociative();
    }
    public function find_ingredient_tomate_sql(): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql= 'SELECT * FROM ingredients
            WHERE ingredients.nom = "tomate" ';

        $resultat = $conn->executeQuery($sql);
        
        return $resultat->fetchAllAssociative();
    }
    public function find_ingredient_tomate_5_sql(): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql= 'SELECT * FROM ingredients
            WHERE ingredients.nom = "tomate" AND ingredients.prix > 5';

        $resultat = $conn->executeQuery($sql);
        
        return $resultat->fetchAllAssociative();
    }
    public function find_ingredient_tom_sql(): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql= 'SELECT * FROM ingredients
            WHERE ingredients.nom LIKE "tom%" ';

        $resultat = $conn->executeQuery($sql);
        
        return $resultat->fetchAllAssociative();
    }
    public function find_ingredient_by_price_sql(float $price): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql= 'SELECT * FROM ingredients
            WHERE ingredients.prix = :price ';

        $resultat = $conn->executeQuery($sql, ['price'=> $price]);
        
        return $resultat->fetchAllAssociative();
    }
    public function find_ingredient_by_price_and_name_sql(float $price, string $name): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql= 'SELECT * FROM ingredients
            WHERE ingredients.prix = :price AND ingredients.nom = :valeur ';

        $resultat = $conn->executeQuery($sql, ['price'=> $price, 'valeur' => $name]);
        
        return $resultat->fetchAllAssociative();
    }
    public function findAll_dql():array 
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
        'SELECT p
        FROM App\Entity\Ingredients p'
        );
        return $query->getResult();
    }
    public function find_ingredient_tomate_dql():array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
        'SELECT p
        FROM App\Entity\Ingredients p
        WHERE p.nom = :nom'
        )->setParameter('nom', 'tomate');
        return $query->getResult();
    }
    public function find_ingredient_tomate_5_dql(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
        'SELECT p
        FROM App\Entity\Ingredients p
        WHERE p.nom = :nom
        AND p.prix > :prix'
        )->setParameter('nom', 'tomate')
        ->setParameter('prix', '5');
        return $query->getResult();
    }
    public function find_ingredient_tom_dql(): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
        'SELECT p
        FROM App\Entity\Ingredients p
        WHERE p.nom LIKE :nom'
        )->setParameter('nom', 'tom%');
        return $query->getResult();
    }
    public function find_ingredient_by_price_dql(float $price): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
        'SELECT p
        FROM App\Entity\Ingredients p
        WHERE p.prix = :nom'
        )->setParameter('nom', $price);
        return $query->getResult();
    }
    public function find_ingredient_by_price_and_name_dql(float $price, string $name): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
        'SELECT p
        FROM App\Entity\Ingredients p
        WHERE p.prix = :prix
        AND p.nom = :nom'
        )->setParameter('nom', $name)
        ->setParameter('prix', $price);
        return $query->getResult();
    }
    public function find_by_slug(string $slug): array
    {
        $entityManager = $this->getEntityManager();

        $query = $entityManager->createQuery(
        'SELECT p
        FROM App\Entity\Ingredients p
        WHERE p.slug = :slug'
        )->setParameter('slug', $slug);
        return $query->getResult();
    } 
    //    public function findOneBySomeField($value): ?Ingredients
    //    {
    //        return $this->createQueryBuilder('i')
    //            ->andWhere('i.exampleField = :val')
    //            ->setParameter('val', $value)
    //            ->getQuery()
    //            ->getOneOrNullResult()
    //        ;
    //    }
}
