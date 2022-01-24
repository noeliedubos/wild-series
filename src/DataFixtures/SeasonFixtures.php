<?php

namespace App\DataFixtures;

use App\Entity\Season;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class SeasonFixtures extends Fixture implements DependentFixtureInterface

{
    public const SEASONS = [
        [
            "number" => 1,
            "year" => 2011,
            "description" => "the beginning",
            "programReference" => "Game of Thrones",
        ],
        [
            "number" => 2,
            "year" => 2012,
            "description" => "winterfell secret",
            "programReference" => "Game of Thrones",
        ],
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::SEASONS as $seasonData){
            $season = new Season();
            $season->setNumber($seasonData["number"]);
            $season->setYear($seasonData["year"]);
            $season->setDescription($seasonData["description"]);
            $season->setProgram($this->getReference($seasonData["programReference"]));
            $this->addReference($seasonData["programReference"] . $seasonData["number"], $season);
            $manager->persist($season);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return[
            ProgramFixtures::class,
        ];
    }
}
