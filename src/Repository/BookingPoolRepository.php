<?php

namespace App\Repository;

use App\Entity\BookingPool;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BookingPool|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookingPool|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookingPool[]    findAll()
 * @method BookingPool[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookingPoolRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BookingPool::class);
    }

    // /**
    //  * @return BookingPool[] Returns an array of BookingPool objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BookingPool
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
