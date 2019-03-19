<?php

namespace App\Repository;

use App\Entity\AbstractUserCourseNodeInstance;
use App\Entity\CourseInstance;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class UserCourseNodeInstanceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AbstractUserCourseNodeInstance::class);
    }

    public function getUserNodes(User $user, CourseInstance $instance)
    {
        $builder = $this->createQueryBuilder('user_node');

        $builder->select('node.id', 'user_node.date', 'user_node as data')
            ->leftJoin('user_node.node', 'node')
            ->where('user_node.instance = :course')->setParameter('course', $instance)
            ->andWhere('user_node.user = :user')->setParameter('user', $user)
        ;

        return $builder->getQuery()->getResult();
    }
}
