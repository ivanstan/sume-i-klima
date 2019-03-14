<?php

namespace App\Repository;

use App\Entity\CourseNodeInstance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CourseNodeInstance|null find($id, $lockMode = null, $lockVersion = null)
 * @method CourseNodeInstance|null findOneBy(array $criteria, array $orderBy = null)
 * @method CourseNodeInstance[]    findAll()
 * @method CourseNodeInstance[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CourseNodeInstanceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CourseNodeInstance::class);
    }

    // /**
    //  * @return CourseNodeInstance[] Returns an array of CourseNodeInstance objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?CourseNodeInstance
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
