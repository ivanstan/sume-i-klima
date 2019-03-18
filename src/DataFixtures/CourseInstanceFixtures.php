<?php

namespace App\DataFixtures;

use App\Entity\Course;
use App\Entity\CourseInstance;
use App\Entity\CourseNodeInstance;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class CourseInstanceFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $courses = $manager->getRepository(Course::class)->findAll();

        /** @var User $admin */
        $admin = $this->getReference(UserFixtures::ADMIN_USER_REFERENCE);

        foreach ($courses as $course) {
            $instance = new CourseInstance();
            $instance->setCourse($course);
            $instance->setDate(new \DateTime('now'));
            $instance->setTimezone(new \DateTimeZone('UTC'));
            $instance->addUser($admin);

            $manager->persist($instance);

            $nodeInstance = new CourseNodeInstance();
            $nodeInstance->setInstance($instance);

            foreach ($course->getNodes() as $node) {
                $nodeInstance->setNode($node);
            }

            $manager->persist($nodeInstance);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            CourseFixtures::class,
        ];
    }
}
