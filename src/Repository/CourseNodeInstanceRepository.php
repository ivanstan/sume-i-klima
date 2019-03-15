<?php

namespace App\Repository;

use App\Entity\Course;
use App\Entity\CourseNodeInstance;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class CourseNodeInstanceRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CourseNodeInstance::class);
    }

    public function getNodes(Course $course)
    {
        $builder = $this->createQueryBuilder('node_instance');

        $builder->select('node_instance');
//            ->join('node_instance.instance', 'course_instance')
//            ->join('node_instance.node', 'course_node')
//            ->join('course_instance.course', 'course');
//            ->where('course.id = :course')->setParameter('course', $course);

        return $builder->getQuery()->getResult();
    }
}
