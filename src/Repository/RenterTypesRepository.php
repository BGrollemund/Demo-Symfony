<?php

namespace App\Repository;

use App\Entity\RenterTypes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method RenterTypes|null find($id, $lockMode = null, $lockVersion = null)
 * @method RenterTypes|null findOneBy(array $criteria, array $orderBy = null)
 * @method RenterTypes[]    findAll()
 * @method RenterTypes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RenterTypesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RenterTypes::class);
    }

    // /**
    //  * @return RenterTypes[] Returns an array of RenterTypes objects
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
    public function findOneBySomeField($value): ?RenterTypes
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
