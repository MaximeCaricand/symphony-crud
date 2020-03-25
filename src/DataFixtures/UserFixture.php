<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use App\Entity\User;

class UserFixture extends Fixture
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
         $this->passwordEncoder = $passwordEncoder;
    }

    public function load(ObjectManager $manager)
    {
        $user = new User();

        $user->setName('admin');
        $roles[] = 'ROLE_ADMIN';
        $user->setRoles($roles);
        $user->setPassword($this->passwordEncoder->encodePassword(
             $user,
             'mdp'
        ));

        $manager->persist($user);

        $user = new User();

        $user->setName('utilisateur'); 
        $user->setPassword($this->passwordEncoder->encodePassword(
             $user,
             'mdp'
        ));

        $manager->persist($user);

        $manager->flush();
    }
}
