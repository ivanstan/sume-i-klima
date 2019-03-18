<?php

namespace App\DataFixtures;

use App\Entity\Course;
use App\Entity\CourseNodeAssignment;
use App\Entity\CourseNodeLesson;
use App\Entity\CourseNodeQuiz;
use App\Entity\QuizQuestionAnswer;
use App\Entity\QuizQuestionResult;
use App\Entity\User;
use App\Entity\UserCourseNodeAssignment;
use App\Entity\UserCourseNodeLesson;
use App\Entity\UserCourseNodeQuiz;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class UserWorksOnCourse extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $courses = $manager->getRepository(Course::class)->findAll();
        /** @var User $user */
        $user = $this->getReference(UserFixtures::ADMIN_USER_REFERENCE);

        foreach ($courses as $course) {
            foreach ($course->getNodes() as $node) {

                if ($node instanceof CourseNodeAssignment) {
                    $userCourseNode = new UserCourseNodeAssignment();
                }

                if ($node instanceof CourseNodeLesson) {
                    $userCourseNode = new UserCourseNodeLesson();
                }

                if ($node instanceof CourseNodeQuiz) {
                    $userCourseNode = new UserCourseNodeQuiz();

                    foreach ($node->getQuestions() as $question) {
                        $result = new QuizQuestionResult();
                        $result->setQuestion($question);

                        $answers = $question->getAnswers()->toArray();

                        /** @var QuizQuestionAnswer $quizQuestionAnswer */
                        $quizQuestionAnswer = $answers[array_rand($answers)];
                        $result->setAnswer($quizQuestionAnswer->getAnswer());

                        $userCourseNode->setResult($result);
                    }
                }

                if (isset($userCourseNode)) {
                    $instance = $course->getInstances()[0];

                    $userCourseNode->setUser($user);
                    $userCourseNode->setInstance($instance);
                    $userCourseNode->setNode($node);
                    $userCourseNode->setDate(new \DateTime('now', new \DateTimeZone(DateTimeService::UTC_TIMEZONE)));
                    $manager->persist($userCourseNode);
                }
            }
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CourseInstanceFixtures::class,
        ];
    }
}
