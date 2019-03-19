<?php

namespace App\Repository;

use App\Entity\Course;
use App\Entity\CourseNodeAssignment;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class CourseAssigmentRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CourseNodeAssignment::class);
    }

    public function getCourseFiles(Course $course)
    {
        return $this->createQueryBuilder('node', 'node.id')
            ->select('node', 'file')
            ->innerJoin('node.course', 'course')
            ->leftJoin('node.file', 'file')
            ->andWhere('course = :course')->setParameter('course', $course)
            ->getQuery()
            ->getResult();
    }
}
