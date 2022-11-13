<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create('pt_BR');

        for($i=1; $i<=10; $i++) {
            $user = new User();
            $user -> setName($faker->name);
            $user -> setCpf($faker->bothify('###.###.###-##'));
            $user -> setEmail($faker->email);
            $user -> setPassword($faker->password);
    
            $manager->persist($user);
        }

        $manager->flush();
    }
}