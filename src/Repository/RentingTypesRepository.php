<?php

namespace App\Repository;

use App\Entity\RentingTypes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RentingTypes|null find($id, $lockMode = null, $lockVersion = null)
 * @method RentingTypes|null findOneBy(array $criteria, array $orderBy = null)
 * @method RentingTypes[]    findAll()
 * @method RentingTypes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RentingTypesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RentingTypes::class);
    }

    // /**
    //  * @return RentingTypes[] Returns an array of RentingTypes objects
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
    public function findOneBySomeField($value): ?RentingTypes
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
