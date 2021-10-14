<?php

namespace App\Repository;

use App\Entity\Mytest;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Mytest|null find($id, $lockMode = null, $lockVersion = null)
 * @method Mytest|null findOneBy(array $criteria, array $orderBy = null)
 * @method Mytest[]    findAll()
 * @method Mytest[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MytestRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Mytest::class);
    }

    // /**
    //  * @return Mytest[] Returns an array of Mytest objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Mytest
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
