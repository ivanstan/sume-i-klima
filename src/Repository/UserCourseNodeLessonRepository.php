<?php

namespace App\Repository;

use App\Entity\UserCourseNodeLesson;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserCourseNodeLesson|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserCourseNodeLesson|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserCourseNodeLesson[]    findAll()
 * @method UserCourseNodeLesson[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserCourseNodeLessonRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserCourseNodeLesson::class);
    }

    // /**
    //  * @return UserCourseNodeLesson[] Returns an array of UserCourseNodeLesson objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UserCourseNodeLesson
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
