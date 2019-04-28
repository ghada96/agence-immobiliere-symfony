<?php

namespace App\DataFixtures;

use App\Entity\Buy;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use Faker\Factory;

class BuyFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker=Factory::create('fr_FR');

        for($i=0;$i<100;$i++){
            $buy=new Buy();
          $buy->setTitle($faker->words(3,true))
                ->setDescription($faker->sentences(3,true))
                ->setSurface($faker->numberBetween(20,350))
                ->setRooms($faker->numberBetween(3,10))
                ->setBedroom($faker->numberBetween(2,12))
                ->setFloor($faker->numberBetween(0,15))
                ->setPrice($faker->numberBetween(200000,3500000))
                ->setCity($faker->city)
                ->setAddress($faker->address)
                ->setCodepostal($faker->postcode)
                ->setSold(false)
                ->setChauffage($faker->words(1,true))
              ;
            $manager->persist($buy);
        }
        $manager->flush();

        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
