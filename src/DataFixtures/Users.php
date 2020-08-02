<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class Users extends Fixture
{
    const USER_2 = 'user_2';
    const USER_1 = 'user_1';

    private UserPasswordEncoderInterface $userPasswordEncoder;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->userPasswordEncoder = $userPasswordEncoder;
    }

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $user1 = new User();
        $user1->setUsername('user1');
        $user1->setPassword($this->userPasswordEncoder->encodePassword($user1, $user1->getUsername()));
        $user1->setRoles(['ROLE_USER']);

        $manager->persist($user1);
        $manager->flush();
        $this->addReference(self::USER_1, $user1);

        $user2 = new User();
        $user2->setUsername('user2');
        $user2->setPassword($this->userPasswordEncoder->encodePassword($user2, $user2->getUsername()));
        $user2->setRoles(['ROLE_USER']);

        $manager->persist($user2);
        $manager->flush();
        $this->addReference(self::USER_2, $user2);
    }
}
