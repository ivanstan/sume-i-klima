<?php

namespace App\Repository;

use App\Entity\CourseNodeAssignment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CourseNodeAssignment|null find($id, $lockMode = null, $lockVersion = null)
 * @method CourseNodeAssignment|null findOneBy(array $criteria, array $orderBy = null)
 * @method CourseNodeAssignment[]    findAll()
 * @method CourseNodeAssignment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class AssignmentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CourseNodeAssignment::class);
    }

    // /**
    //  * @return CourseNodeAssignment[] Returns an array of CourseNodeAssignment objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('a.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CourseNodeAssignment
    {
        return $this->createQueryBuilder('a')
            ->andWhere('a.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
