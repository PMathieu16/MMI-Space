<?php

namespace App\Repository;

use App\Entity\FieldStudy;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method FieldStudy|null find($id, $lockMode = null, $lockVersion = null)
 * @method FieldStudy|null findOneBy(array $criteria, array $orderBy = null)
 * @method FieldStudy[]    findAll()
 * @method FieldStudy[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class FieldStudyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FieldStudy::class);
    }

    // /**
    //  * @return FieldStudy[] Returns an array of FieldStudy objects
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
    public function findOneBySomeField($value): ?FieldStudy
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
