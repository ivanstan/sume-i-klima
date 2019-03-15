<?php

namespace App\DataFixtures;

use App\Entity\Course;
use App\Entity\CourseNodeEnvelope;
use App\Entity\CourseNodeLesson;
use App\Entity\CourseNodeQuiz;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class CourseFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 5; $i++) {
            $course = new Course();
            $course->setName('Course ' . $i);
            $course->setLanguage('en');
            $course->setActive(true);

            for($j = 0; $j < 2; $j++) {
                $envelope = new CourseNodeEnvelope();
                $envelope->setName('Week ' . $j);
                $envelope->setWeight(0);
                $envelope->setCourse($course);
                $manager->persist($envelope);

                $lesson = new CourseNodeLesson();
                $lesson->setName('CourseNodeLesson ' . $j);
                $lesson->setWeight(0);
                $lesson->setParent($envelope);
                $lesson->setCourse($course);
                $manager->persist($lesson);

                $quiz = new CourseNodeQuiz();
                $quiz->setWeight(0);
                $quiz->setParent($envelope);
                $quiz->setCourse($course);
                $manager->persist($quiz);

//                $assigment = new CourseNodeAssignment();
//                $assigment->setWeight(0);
//                $assigment->setParent($envelope);
//                $assigment->setCourse($course);
//                $manager->persist($assigment);
            }

            $manager->persist($course);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
        ];
    }
}
