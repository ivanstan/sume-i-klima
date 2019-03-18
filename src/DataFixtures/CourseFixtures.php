<?php

namespace App\DataFixtures;

use App\Entity\Course;
use App\Entity\CourseNodeAssignment;
use App\Entity\CourseNodeEnvelope;
use App\Entity\CourseNodeLesson;
use App\Entity\CourseNodeQuiz;
use App\Entity\File;
use App\Entity\QuizAnswer;
use App\Entity\QuizQuestion;
use App\Entity\QuizQuestionAnswer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CourseFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 2; $i++) {
            $course = new Course();
            $course->setName('Course ' . $i);
            $course->setLanguage('en');
            $course->setActive(true);

            for($j = 0; $j < 5; $j++) {
                $envelope = new CourseNodeEnvelope();
                $envelope->setName('Week ' . $j);
                $envelope->setWeight(0);
                $envelope->setCourse($course);

                if ($j > 0) {
                    $days = $j * 7;
                    $envelope->setAvailableAfter(new \DateInterval("P{$days}D"));
                }

                $manager->persist($envelope);

                $lesson = new CourseNodeLesson();
                $lesson->setName('CourseNodeLesson ' . $j);
                $lesson->setWeight(0);
                $lesson->setParent($envelope);
                $lesson->setCourse($course);
                $lesson->setWeight(1);
                $lesson->setUrl('https://www.youtube.com/watch?v=a3ICNMQW7Ok');
                $manager->persist($lesson);

                $quiz = new CourseNodeQuiz();
                $quiz->setWeight(0);
                $quiz->setParent($envelope);
                $quiz->setWeight(2);
                $quiz->setName('Sample Quiz');
                $quiz->setCourse($course);

                for ($questionId = 0; $questionId < 10; $questionId++) {
                    $question = new QuizQuestion();
                    $question->setQuiz($quiz);
                    $question->setContent('Sample question?');
                    $question->setType(QuizQuestion::TYPES[array_rand(QuizQuestion::TYPES)]);
                    $manager->persist($question);

                    for ($answerId = 0; $answerId < 4; $answerId++) {
                        $answer = new QuizAnswer();
                        $correct = (bool)random_int(0,1);

                        $answer->setContent($correct ? 'Correct answer' : 'Incorrect answer');
                        $manager->persist($answer);

                        $questionAnswer = new QuizQuestionAnswer();
                        $questionAnswer->setAnswer($answer);
                        $questionAnswer->setQuestion($question);
                        $questionAnswer->setCorrect($correct);

                        $manager->persist($questionAnswer);

                        $question->addAnswer($questionAnswer);
                    }

                    $quiz->addQuestion($question);
                }

                $manager->persist($quiz);

                $assigment = new CourseNodeAssignment();
                $assigment->setWeight(0);
                $assigment->setParent($envelope);
                $assigment->setCourse($course);
                $assigment->setName('Sample Assigment');
                $assigment->setContent('Sample content');
                $assigment->setWeight(3);
                $files = $manager->getRepository(File::class)->findAll();
                $assigment->setFile($files[array_rand($files)]);
                $manager->persist($assigment);
            }

            $manager->persist($course);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            FileFixtures::class,
        ];
    }
}
