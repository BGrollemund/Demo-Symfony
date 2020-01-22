<?php

namespace App\Repository;

use App\Entity\BookingTax;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method BookingTax|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookingTax|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookingTax[]    findAll()
 * @method BookingTax[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookingTaxRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BookingTax::class);
    }

    // /**
    //  * @return BookingTax[] Returns an array of BookingTax objects
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
    public function findOneBySomeField($value): ?BookingTax
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
