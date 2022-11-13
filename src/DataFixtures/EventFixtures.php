<?php

namespace App\DataFixtures;

use App\Entity\Event;
use App\Entity\Lecture;
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

            $lecture1 = new Lecture();
            $lecture1->setTitle('Evento TESTE');
            $lecture1->setDate('1997-12-01');
            $lecture1->setStartTime('12:40:34');
            $lecture1->setEndTime('13:30:40');
            $lecture1->setDescription('Teste relationships');
            $lecture1->setEventId($event);

            $lecture2 = new Lecture();
            $lecture2->setTitle('Evento TESTE 2');
            $lecture2->setDate('1997-12-01');
            $lecture2->setStartTime('12:40:34');
            $lecture2->setEndTime('13:30:40');
            $lecture2->setDescription('Teste relationships 2');
            $lecture2->setEventId($event);
    
            $manager->persist($lecture1);
            // $manager->persist($event);
        }

        $manager->flush();
    }
}