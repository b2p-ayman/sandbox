<?php

namespace App\Repository;

use App\Entity\HistoriqueEnvoi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method HistoriqueEnvoi|null find($id, $lockMode = null, $lockVersion = null)
 * @method HistoriqueEnvoi|null findOneBy(array $criteria, array $orderBy = null)
 * @method HistoriqueEnvoi[]    findAll()
 * @method HistoriqueEnvoi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HistoriqueEnvoiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, HistoriqueEnvoi::class);
    }

    // /**
    //  * @return HistoriqueEnvoi[] Returns an array of HistoriqueEnvoi objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?HistoriqueEnvoi
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
