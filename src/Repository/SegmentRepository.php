<?php

namespace App\Repository;

use App\Entity\CourseSegment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CourseSegment|null find($id, $lockMode = null, $lockVersion = null)
 * @method CourseSegment|null findOneBy(array $criteria, array $orderBy = null)
 * @method CourseSegment[]    findAll()
 * @method CourseSegment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SegmentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CourseSegment::class);
    }

    // /**
    //  * @return CourseSegment[] Returns an array of CourseSegment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CourseSegment
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
