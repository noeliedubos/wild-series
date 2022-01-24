<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    const CATEGORIES =[
        'Action',
        'Aventure',
        'Animation',
        'Fantastique',
        'Horreur',
    ];

    public function load(ObjectManager $manager)
    {
        foreach (self::CATEGORIES AS $key => $categoryName) {
            $category = new Category();
            $category -> setName($categoryName);
            $this->addReference($categoryName, $category);
            $manager->persist ($category);
        }    
        $manager->flush();
    }
}