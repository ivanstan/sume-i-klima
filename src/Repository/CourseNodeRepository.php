<?php

namespace App\Repository;

use App\Entity\AbstractCourseNode;
use App\Entity\Course;
use App\Entity\CourseNodeQuiz;
use App\Entity\QuizAnswer;
use App\Entity\QuizQuestion;
use App\Entity\QuizQuestionAnswer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\Query\Expr\Join;
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

        $builder->select('node', 'course'
//            ,
//            'quiz', 'quiz_question', 'answers', 'answer'
        )
            ->innerJoin('node.course', 'course')
//            ->leftJoin(CourseNodeQuiz::class, 'quiz', Join::WITH, 'quiz.id = node.id')
//            ->leftJoin(QuizQuestion::class, 'quiz_question', Join::WITH, 'quiz_question.quiz = quiz.id')
//            ->leftJoin('quiz_question.answers', 'answers')
//            ->leftJoin('answers.answer', 'answer')
            ->where('course.id = :course')->setParameter('course', $course)
            ->andWhere('node.parent IS NULL')
//            ->andWhere('node INSTANCE OF App\Entity\CourseNodeEnvelope')
        ;

        echo "<pre>"; print_r($builder->getQuery()->getSQL()); echo "</pre>"; die();

        return $builder->getQuery()->getResult();
    }
}
