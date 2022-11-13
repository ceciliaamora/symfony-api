<?php

namespace App\DataFixtures;

use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class EventFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('pt_BR');

        for($i=1; $i<=10; $i++) {
            $event = new Event();
            $event->setTitle($faker->sentence(3));
            $event->setDescription($faker->text(100));
            $event->setStartDateTime($faker->dateTime());
            $event->setEndDateTime($faker->dateTime());
            $event->setStatus($faker->word());
    
            $manager->persist($event);
        }

        $manager->flush();
    }
}