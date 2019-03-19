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

    public function getNodes(Course $course): array
    {
        $builder = $this->createQueryBuilder('node_instance');

        $builder->select('node_instance', 'course_node')
            ->leftJoin('node_instance.instance', 'course_instance')
            ->leftJoin('node_instance.node', 'course_node')
            ->leftJoin('course_instance.course', 'course')
            ->where('course = :course')->setParameter('course', $course);

        $result = [];

        /** @var CourseNodeInstance $node */
        foreach ($builder->getQuery()->getResult() as $node) {
            $result[$node->getNode()->getId()] = $node;
        }

        return $result;
    }
}
