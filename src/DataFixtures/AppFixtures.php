<?php

namespace App\DataFixtures;

use App\Entity\Admin;
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
#        $comment->setCreatedAt(new \DateTimeImmutable());
#        $comment->setConference($conference);
        $conference->addComment($comment);

#        $manager->merge($comment);
        $manager->persist($comment);
        $manager->flush();

        $this->storeNewYork2021($manager);
        $this->storeAdmin($manager);
    }

    private function storeNewYork2021($manager)
    {
        $conference = new Conference();
        $conference->setCity('NewYork');
        $conference->setYear('2021');
        $conference->setIsInternational(true);

        $manager->persist($conference);
        $manager->flush();

        $this->storeComments($manager, $conference, [
            ['Alis', 'Hi'],
            ['Bob', 'How are you?'],
            ['Alis', 'Fine thank you, and you?'],
            ['Bob', 'Grate!'],
            ['Cathy', 'Wow!'],
        ]);
    }

    // [auther, comemnt]
    public function storeComments($manager, $conference, $dataList = [])
    {
        foreach ($dataList as $data) {
            $comment = new Comment();
            $comment->setAuthor($data[0]);
            $comment->setText($data[1]);
            $comment->setEmail("{$data[0]}@google.com");
#            $comment->setCreatedAt(new \DateTimeImmutable());
            $conference->addComment($comment);

            $manager->persist($comment);
            $manager->flush();
        }
    }

    private function storeAdmin($manager)
    {
        $admin = new Admin();
        $admin->setUsername('admin');
        $admin->setPassword('$2y$13$lJ.kJVwxCdIKqau/Ym/gZebTP6vCoJVDXc6fAHvtYcjdmNhJbHcHy');
        $admin->setRoles(['ROLE_ADMIN']);

        $manager->persist($admin);
        $manager->flush();
    }
}
