<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;
    public const USER_1_REFERENCE = 'user-1';

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager)
    {
        /*$user = new User();
        $user->setEmail('ayman@email.com');
        $user->setPassword($this->passwordHasher->hashPassword($user, 'passAyman'));

        $manager->persist($user);
        $this->addReference(self::USER_1_REFERENCE, $user);

        $manager->flush();
        */
    }
}
