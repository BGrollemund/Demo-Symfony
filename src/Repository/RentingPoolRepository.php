<?php

namespace App\Repository;

use App\Entity\RentingPool;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RentingPool|null find($id, $lockMode = null, $lockVersion = null)
 * @method RentingPool|null findOneBy(array $criteria, array $orderBy = null)
 * @method RentingPool[]    findAll()
 * @method RentingPool[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RentingPoolRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RentingPool::class);
    }

    // /**
    //  * @return RentingPool[] Returns an array of RentingPool objects
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
    public function findOneBySomeField($value): ?RentingPool
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
