<?php

namespace App\DataFixtures;

use App\Entity\BlogPost;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class BlogPosts extends Fixture implements DependentFixtureInterface
{
    const BLOG_POST_1 = 'blog_post_1';
    const BLOG_POST_2 = 'blog_post_2';

    /**
     * {@inheritdoc}
     */
    public function load(ObjectManager $manager)
    {
        $users = [$this->getReference(Users::USER_1), $this->getReference(Users::USER_2)];

        $blogPosts = [];
        for ($i = 0; $i < 40; $i++) {
            $userIdx = $i % 2;
            $user = $users[$userIdx];
            $blogPost = new BlogPost();
            $blogPost->setAuthor($user);
            $blogPost->setTitle('Title ' . $i);
            $blogPost->setContent('Content ' . $i);

            $manager->persist($blogPost);

            if ($i === 0) {
                $manager->flush();
                $this->setReference(self::BLOG_POST_1, $blogPost);
            }

            if ($i === 1) {
                $manager->flush();
                $this->setReference(self::BLOG_POST_2, $blogPost);
            }
        }

        $manager->flush();
    }

    /**
     * {@inheritdoc}
     */
    public function getDependencies()
    {
        return [Users::class];
    }
}
