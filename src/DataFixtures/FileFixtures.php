<?php

namespace App\DataFixtures;

use App\Entity\File;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class FileFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        for ($i = 0; $i < 20; $i++) {
            $file = new File();
            $file->setDestination('public/build/app.css');
            $file->setSize(19020);
            $file->setMime('application/stylesheet');
            $file->setUser(null);

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
