<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture implements DependentFixtureInterface
{
    public const ADMIN_USER_REFERENCE = 'admin-user';

    /** @var UserPasswordEncoderInterface */
    private $encoder;

    private const PASSWORD = 'test123';

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager): void
    {
        // Add admin user
        $user = new User();
        $user->setEmail('ivanstan@gmail.com');
        $user->setRoles([User::ROLE_ADMIN]);
        $user->setActive(true);
        $user->setVerified(true);
        $user->setPassword(self::PASSWORD);
        $user->setPassword($this->encoder->encodePassword($user, $user->getPassword()));

        $manager->persist($user);

        $this->addReference(self::ADMIN_USER_REFERENCE, $user);

        for ($i = 0; $i < 10; $i++) {
            $user = new User();
            $user->setEmail("user{$i}@gmail.com");
            $user->setRoles([User::ROLE_USER]);
            $user->setActive((bool)random_int(0,1));
            $user->setVerified((bool)random_int(0,1));
            $user->setPassword(self::PASSWORD);
            $user->setPassword($this->encoder->encodePassword($user, $user->getPassword()));
            $user->setOrganization($this->getReference(OrganizationFixtures::ORGANIZATION));

            $manager->persist($user);
        }

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [
            OrganizationFixtures::class,
        ];
    }
}
