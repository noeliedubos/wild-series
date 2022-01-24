<?php

namespace App\DataFixtures;

use App\Entity\Program;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;


class ProgramFixtures extends Fixture implements DependentFixtureInterface
{

    const PROGRAMS = [
        [ 
            "title"=>"Game of Thrones",
            "summary"=>"Neuf nobles familles se battent pour le contrôle des terres mythiques de Westeros, tandis qu'un ancien ennemi revient après avoir été endormi pendant des milliers d'années.", 
            "poster"=>"https://ibb.co/jhvbBG1",
            "programCategory" => 'Fantastique',
        ],
        [ 
            "title"=>"Lost",
            "summary"=>"Après le crash de leur avion sur une île perdue, les survivants doivent apprendre à cohabiter et survivre dans cet environnement hostile. Bien vite, ils se rendent compte qu'une menace semble planer sur l'île...", 
            "poster"=>"https://media.ouest-france.fr/v1/pictures/MjAyMTA4YmFiYjFmNzU5ZDRmY2E5YzQ0Zjk3OGE0YWFkNmU0NTI?width=630&focuspoint=50%2C25&cropresize=1&client_id=bpeditorial&sign=69937ec08d79c71a01f65d9a4835dac0dce513b236c5a0f7eb2b949fb971435b",
            "programCategory" => 'Aventure',
        ]
        ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::PROGRAMS as $oneProgram){
            $program = new Program();
            $program->setTitle($oneProgram['title']);
            $program->setSummary($oneProgram['summary']);
            $program->setPoster($oneProgram['poster']);
            $program->setCategory($this->getReference($oneProgram["programCategory"]));
            $this->addReference($oneProgram["title"], $program);
            $manager->persist($program);
        }

        $manager->flush();
        
    }
    public function getDependencies()
    {
        return[
            CategoryFixtures::class,
        ];
    }
}