<?php

namespace App\Repository;

use App\Entity\QuizAnwser;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method QuizAnwser|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuizAnwser|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuizAnwser[]    findAll()
 * @method QuizAnwser[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuizAnwserRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, QuizAnwser::class);
    }

    // /**
    //  * @return QuizAnwser[] Returns an array of QuizAnwser objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?QuizAnwser
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
