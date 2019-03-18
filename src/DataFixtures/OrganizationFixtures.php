<?php

namespace App\DataFixtures;

use App\Entity\Organization;
use Doctrine\Bundle\FixturesBundle\Fixture;
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
