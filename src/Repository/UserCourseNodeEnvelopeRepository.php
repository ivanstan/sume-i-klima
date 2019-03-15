<?php

namespace App\Repository;

use App\Entity\UserCourseNodeEnvelope;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method UserCourseNodeEnvelope|null find($id, $lockMode = null, $lockVersion = null)
 * @method UserCourseNodeEnvelope|null findOneBy(array $criteria, array $orderBy = null)
 * @method UserCourseNodeEnvelope[]    findAll()
 * @method UserCourseNodeEnvelope[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UserCourseNodeEnvelopeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, UserCourseNodeEnvelope::class);
    }

    // /**
    //  * @return UserCourseNodeEnvelope[] Returns an array of UserCourseNodeEnvelope objects
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
    public function findOneBySomeField($value): ?UserCourseNodeEnvelope
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
