<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class EpisodeFixtures extends Fixture implements DependentFixtureInterface

{
    const EPISODES =  [
        [ "title"=>"Winter Is Coming", "number"=>1, 
        "synopsis"=>"Eddard Stark is torn between his family and an old friend when asked to serve at the side of King Robert Baratheon; Viserys plans to wed his sister to a nomadic warlord in exchange for an army.",
        "seasonReference" => 'Game of Thrones1'],
        [ "title"=>"The Kingsroad", "number"=>2,
        "synopsis"=>"While Bran recovers from his fall, Ned takes only his daughters to King's Landing. Jon Snow goes with his uncle Benjen to the Wall. Tyrion joins them.",
        "seasonReference" => 'Game of Thrones1'],
        [ "title"=>"Lord Snow", "number"=>3, 
        "synopsis"=>"Jon begins his training with the Night's Watch; Ned confronts his past and future at King's Landing; Daenerys finds herself at odds with Viserys",
        "seasonReference" => 'Game of Thrones1'],
        [ "title"=>"Cripples, Bastards, and Broken Things", "number"=>4, 
        "synopsis"=>"Eddard investigates Jon Arryn's murder. Jon befriends Samwell Tarly, a coward who has come to join the Night's Watch.",
        "seasonReference" => 'Game of Thrones1'],
        [ "title"=>"The Wolf and the Lion", "number"=>5, 
        "synopsis"=>"Catelyn has captured Tyrion and plans to bring him to her sister, Lysa Arryn, at the Vale, to be tried for his, supposed, crimes against Bran. Robert plans to have Daenerys killed, but Eddard refuses to be a part of it and quits.",
        "seasonReference" => 'Game of Thrones1'],

    ];


    public function load(ObjectManager $manager): void
    {
        foreach (self::EPISODES AS $oneEpisode){
            $episode = new Episode();
            $episode->setTitle($oneEpisode['title']);  
            $episode->setnumber($oneEpisode['number']);  
            $episode->setSynopsis($oneEpisode['synopsis']);  
            $episode->setSeason($this->getReference($oneEpisode['seasonReference'])); 
            $manager->persist($episode);

        }
        $manager->flush();
    }

    public function getDependencies()
    {
        return[
            SeasonFixtures::class,
        ];
    }
}
