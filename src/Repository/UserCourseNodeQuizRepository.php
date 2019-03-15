<?php

namespace App\Repository;

use App\Entity\UserCourseNodeQuiz;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserCourseNodeQuiz|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserCourseNodeQuiz|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserCourseNodeQuiz[]    findAll()
 * @method UserCourseNodeQuiz[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserCourseNodeQuizRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserCourseNodeQuiz::class);
    }

    // /**
    //  * @return UserCourseNodeQuiz[] Returns an array of UserCourseNodeQuiz objects
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
    public function findOneBySomeField($value): ?UserCourseNodeQuiz
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
