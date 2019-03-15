<?php

namespace App\Repository;

use App\Entity\AbstractUserCourseNodeAssignment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method AbstractUserCourseNodeAssignment|null find($id, $lockMode = null, $lockVersion = null)
 * @method AbstractUserCourseNodeAssignment|null findOneBy(array $criteria, array $orderBy = null)
 * @method AbstractUserCourseNodeAssignment[]    findAll()
 * @method AbstractUserCourseNodeAssignment[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserCourseNodeAssignmentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AbstractUserCourseNodeAssignment::class);
    }

    // /**
    //  * @return UserCourseNodeAssignment[] Returns an array of UserCourseNodeAssignment objects
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
    public function findOneBySomeField($value): ?UserCourseNodeAssignment
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
