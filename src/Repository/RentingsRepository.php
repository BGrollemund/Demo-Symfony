<?php

namespace App\Repository;

use App\Entity\Rentings;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;
use Doctrine\ORM\Query;

/**
 * @method Rentings|null find($id, $lockMode = null, $lockVersion = null)
 * @method Rentings|null findOneBy(array $criteria, array $orderBy = null)
 * @method Rentings[]    findAll()
 * @method Rentings[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RentingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Rentings::class);
    }

    public function findAllQuery(): Query
    {
        return $this->createQueryBuilder('r')
            ->orderBy('r.id', 'DESC')
            ->getQuery();
    }

    // /**
    //  * @return Rentings[] Returns an array of Rentings objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Rentings
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
