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

        $this->storeNewYork2021($manager);
    }

    private function storeNewYork2021($manager)
    {
        $conference = new Conference();
        $conference->setCity('NewYork');
        $conference->setYear('2021');
        $conference->setIsInternational(true);

        $manager->persist($conference);
        $manager->flush();

        $comment = new Comment();
        $comment->setAuthor('Jhon');
        $comment->setText('lorem ipsum');
        $comment->setEmail('jhon@google.com');
        $comment->setCreatedAt(new \DateTimeImmutable());
        $conference->addComment($comment);

        $manager->persist($comment);
        $manager->flush();

        $comment = new Comment();
        $comment->setAuthor('Smith');
        $comment->setText('foobarctjm3q94ugecgjhuher;ahmcgaowcerchma8wethgae;cngyaw8ot;fqacw48ntchertusewhnctawoinwfueichngawoiuc;gocn;aocmy awerctg[wna;ohgwcnhawcngcwnichcwcfghnuanhgciocnerionccawhcgfhacwhgiocna8ncgw8cngaw8chng8wnacuincucga8wn8gor');
        $comment->setEmail('smith@google.com');
        $comment->setCreatedAt(new \DateTimeImmutable());
        $conference->addComment($comment);

        $manager->persist($comment);
        $manager->flush();
    }
}
