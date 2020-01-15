<?php

namespace App\Repository;

use App\Entity\PricesPool;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PricesPool|null find($id, $lockMode = null, $lockVersion = null)
 * @method PricesPool|null findOneBy(array $criteria, array $orderBy = null)
 * @method PricesPool[]    findAll()
 * @method PricesPool[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PricesPoolRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PricesPool::class);
    }

    // /**
    //  * @return PricesPool[] Returns an array of PricesPool objects
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
    public function findOneBySomeField($value): ?PricesPool
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
