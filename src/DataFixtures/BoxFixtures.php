<?php

namespace App\DataFixtures;

use App\Entity\Box;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class BoxFixtures extends Fixture
{
    protected $faker;
    public function load(ObjectManager $manager)
    {
        $this->manager = $manager;
        $this->faker = Factory::create();
        for ($i=0;$i<50;$i++){
            $box = new Box();
            $box->setName($this->faker->name);
             $manager->persist($box);
        }
        // $product = new Product();


        $this->manager->flush();
    }
}
