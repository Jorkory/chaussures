<?php

namespace App\DataFixtures;

use App\Factory\ShoeFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        ShoeFactory::createMany(21);
    }
}
