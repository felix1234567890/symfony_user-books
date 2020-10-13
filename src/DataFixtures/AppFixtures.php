<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Fidry\AliceDataFixtures\Loader\PurgerLoader;

class AppFixtures extends Fixture
{
    private PurgerLoader $loader;
    public function __construct(PurgerLoader $loader)
    {
        $this->loader = $loader;
    }
    public function load(ObjectManager $manager)
    {
        $this->loader->load([__DIR__ . '/../../fixtures/data.yaml']);
    }
}
