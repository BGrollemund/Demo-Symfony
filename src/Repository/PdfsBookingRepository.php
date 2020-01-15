<?php

namespace App\Repository;

use App\Entity\PdfsBooking;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PdfsBooking|null find($id, $lockMode = null, $lockVersion = null)
 * @method PdfsBooking|null findOneBy(array $criteria, array $orderBy = null)
 * @method PdfsBooking[]    findAll()
 * @method PdfsBooking[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PdfsBookingRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PdfsBooking::class);
    }

    // /**
    //  * @return PdfsBooking[] Returns an array of PdfsBooking objects
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
    public function findOneBySomeField($value): ?PdfsBooking
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
