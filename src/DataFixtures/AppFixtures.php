<?php

namespace App\DataFixtures;

use App\Entity\Comment;
use App\Entity\Conference;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $conference = new Conference();
        $conference->setCity('Washinton');
        $conference->setYear('2020');
        $conference->setIsInternational(false);

        $manager->persist($conference);
        $manager->flush();

        $comment = new Comment();
        $comment->setAuthor('Kyosuke');
        $comment->setText('hello');
        $comment->setEmail('kyosuke@google.com');
        $comment->setCreatedAt(new \DateTimeImmutable());
#        $comment->setConference($conference);
        $conference->addComment($comment);

#        $manager->merge($comment);
        $manager->persist($comment);
        $manager->flush();
    }
}
