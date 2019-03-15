<?php

namespace App\DataFixtures;

use App\Entity\Course;
use App\Entity\CourseNodeAssignment;
use App\Entity\CourseNodeEnvelope;
use App\Entity\CourseNodeLesson;
use App\Entity\CourseNodeQuiz;
use App\Entity\File;
use App\Entity\Organization;
use App\Entity\QuizAnswer;
use App\Entity\QuizQuestion;
use App\Entity\QuizQuestionAnswer;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class OrganizationFixtures extends Fixture
{
    public const ORGANIZATION = 'organization';

    public function load(ObjectManager $manager): void
    {
        $organization = new Organization();
        $organization->setName('Default Organization');
        $manager->persist($organization);
        $manager->flush();

        $this->addReference(self::ORGANIZATION, $organization);
    }
}
