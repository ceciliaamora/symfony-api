<?php

namespace App\DataFixtures;

use App\Entity\Lecture;
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

            $manager->persist($lecture);
        }

        $manager->flush();
    }
}