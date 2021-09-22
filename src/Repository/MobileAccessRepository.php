<?php

namespace App\Repository;

use App\Entity\MobileAccess;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MobileAccess|null find($id, $lockMode = null, $lockVersion = null)
 * @method MobileAccess|null findOneBy(array $criteria, array $orderBy = null)
 * @method MobileAccess[]    findAll()
 * @method MobileAccess[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MobileAccessRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MobileAccess::class);
    }

    // /**
    //  * @return MobileAccess[] Returns an array of MobileAccess objects
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
    public function findOneBySomeField($value): ?MobileAccess
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
