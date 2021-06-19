<?php

namespace App\Repository;

use App\Entity\FieldActivity;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FieldActivity|null find($id, $lockMode = null, $lockVersion = null)
 * @method FieldActivity|null findOneBy(array $criteria, array $orderBy = null)
 * @method FieldActivity[]    findAll()
 * @method FieldActivity[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FieldActivityRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FieldActivity::class);
    }

    // /**
    //  * @return FieldActivity[] Returns an array of FieldActivity objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('f.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?FieldActivity
    {
        return $this->createQueryBuilder('f')
            ->andWhere('f.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
