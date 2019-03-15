<?php

namespace App\DataFixtures;

use App\Entity\File;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class FileFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 20; $i++) {
            $file = new File();
            $file->setDestination('public/build/app.css');
            $file->setSize(19020);
            $file->setMime('application/stylesheet');
            $file->setUser($this->getReference(UserFixtures::ADMIN_USER_REFERENCE));

            $manager->persist($file);
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
