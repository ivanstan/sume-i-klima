<?php

namespace App\Repository;

use App\Entity\Course;
use App\Entity\CourseNodeQuiz;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

class CourseQuizRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CourseNodeQuiz::class);
    }

    public function getCourseQuizzes(Course $course)
    {
        return $this->createQueryBuilder('quiz', 'quiz.id')
            ->select('quiz', 'questions', 'answers', 'answer')
            ->leftJoin('quiz.course', 'course')
            ->leftJoin('quiz.questions', 'questions')
            ->leftJoin('questions.answers', 'answers')
            ->leftJoin('answers.answer', 'answer')
            ->andWhere('course = :course')->setParameter('course', $course)
            ->getQuery()
            ->getResult();
    }
}
