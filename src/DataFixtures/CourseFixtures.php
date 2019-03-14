<?php

namespace App\DataFixtures;

use App\Entity\Assignment;
use App\Entity\Course;
use App\Entity\Envelope;
use App\Entity\Lesson;
use App\Entity\Quiz;
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
                $envelope = new Envelope();
                $envelope->setName('Week ' . $j);
                $envelope->setWeight(0);
                $envelope->setCourse($course);
                $manager->persist($envelope);

                $lesson = new Lesson();
                $lesson->setName('Lesson ' . $j);
                $lesson->setWeight(0);
                $lesson->setParent($envelope);
                $lesson->setCourse($course);
                $manager->persist($lesson);

                $quiz = new Quiz();
                $quiz->setWeight(0);
                $quiz->setParent($envelope);
                $quiz->setCourse($course);
                $manager->persist($quiz);

                $assigment = new Assignment();
                $assigment->setWeight(0);
                $assigment->setParent($envelope);
                $assigment->setCourse($course);
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
        ];
    }
}
