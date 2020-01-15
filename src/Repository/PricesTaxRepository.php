<?php

namespace App\Repository;

use App\Entity\PricesTax;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PricesTax|null find($id, $lockMode = null, $lockVersion = null)
 * @method PricesTax|null findOneBy(array $criteria, array $orderBy = null)
 * @method PricesTax[]    findAll()
 * @method PricesTax[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PricesTaxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PricesTax::class);
    }

    // /**
    //  * @return PricesTax[] Returns an array of PricesTax objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PricesTax
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
