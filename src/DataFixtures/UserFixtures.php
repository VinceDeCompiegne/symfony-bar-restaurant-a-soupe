<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private $passwordEncoder;
    public function __construct(UserPasswordHasherInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setNom('admin');
        $user->setPrenom('Restaurant');
        $user->setDate(new \DateTime(date("Y-m-d")));
        $user->setRoles(["ROLE_ADMIN"]);
        $user->setEmail('admin@root.net');
        $user->setPassword($this ->passwordEncoder->hashPassword($user, 'motdepasse'));
        $manager->persist($user);
        $manager->flush();
    }
}
