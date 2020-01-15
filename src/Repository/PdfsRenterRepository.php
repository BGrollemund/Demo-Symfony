<?php

namespace App\Repository;

use App\Entity\PdfsRenter;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method PdfsRenter|null find($id, $lockMode = null, $lockVersion = null)
 * @method PdfsRenter|null findOneBy(array $criteria, array $orderBy = null)
 * @method PdfsRenter[]    findAll()
 * @method PdfsRenter[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PdfsRenterRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PdfsRenter::class);
    }

    // /**
    //  * @return PdfsRenter[] Returns an array of PdfsRenter objects
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
    public function findOneBySomeField($value): ?PdfsRenter
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
