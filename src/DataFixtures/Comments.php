<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use App\Entity\Comment;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class Comments extends Fixture implements DependentFixtureInterface
{
    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [BlogPosts::class];
    }

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $users = [$this->getReference(Users::USER_1), $this->getReference(Users::USER_2)];
        /** @var BlogPost $blogPost */
        $blogPost = $this->getReference(BlogPosts::BLOG_POST_1);
        for ($i = 0; $i < 40; $i++) {
            $userIdx = $i % 2;
            $user = $users[$userIdx];
            $comment = new Comment($blogPost, $user, 'Content ' . $i);

            $manager->persist($comment);
        }

        $manager->flush();
    }
}
