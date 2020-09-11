<?php

namespace App\DataFixtures;

use App\Entity\Box;
use App\Entity\Runes;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class RunesFixtures extends Fixture
{
    protected $faker;
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        $this->faker = Factory::create();
        for ($i=0;$i<50;$i++){
            $runes = new Runes();
            $runes->setName($this->faker->name);
            $manager->persist($runes);
        }
        // $product = new Product();


        $this->manager->flush();
    }
}
