<?php

namespace App\Repository;

use App\Entity\AbstractCourseNode;
use App\Entity\Course;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class CourseNodeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, AbstractCourseNode::class);
    }

    public function getNodes(Course $course)
    {
        $builder = $this->createQueryBuilder('node');

        $builder->select('node')
            ->join('node.course', 'course')
            ->where('course.id = :course')->setParameter('course', $course)
            ->andWhere('node.parent IS NULL')
            ->andWhere('node INSTANCE OF App\Entity\CourseNodeEnvelope');

        return $builder->getQuery()->getResult();
    }
}
