<?php

namespace App\DataFixtures;

use App\Entity\Lecture;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class LectureFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('pt_BR');

        for($i=1; $i<=10; $i++) {
            $lecture = new Lecture();
            $lecture->setTitle($faker->sentence(3));
            $lecture->setDate($faker->date());
            $lecture->setStartTime($faker->time());
            $lecture->setEndTime($faker->time());
            $lecture->setDescription($faker->text(100));

            $user1 = new User();
            $user1->setName('Lecture-User');
            $user1->setCpf('123.456.789-0');
            $user1->setEmail('email@email.com');
            $user1->setPassword('livre');
            $user1->setLecture($lecture);

            $user2 = new User();
            $user2->setName('Lecture-User - 2');
            $user2->setCpf('987.654.321-0');
            $user2->setEmail('newmail@email.com');
            $user2->setPassword('testing');
            $user2->setLecture($lecture);
    
            $manager->persist($user1);        }

        $manager->flush();
    }
}