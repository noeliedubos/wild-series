<?php
// src/Controller/ProgramController.php
namespace App\Controller;

use App\Entity\Program;
use App\Entity\Season;
use App\Repository\EpisodeRepository;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

    /**
    * @Route("/program", name="program_")
    */
class ProgramController extends AbstractController
{
    /**
     * Show all rows from Program's entity
     * 
     * @Route("/", name="index")
     * @return Response A response instance
     */
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findAll();

        return $this->render(
            'program/index.html.twig', 
            ['programs' => $programs],
         );
    }

    /**
     * Getting a program by id
      * @Route("/show/{id<^[0-9]+$>}", name="show")
      * @return Response
      */
    public function show(int $id): Response
    {
        $program = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findOneBy(['id' => $id]);

        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : '.$id.' found in program\'s table/.'
            );
        }
        return $this->render('program/show.html.twig', [
            'program' => $program,
        ]);

    }

     /**
     * Getting a program by season
      * @Route("/program/{programId}/seasons/{seasonId}", name="season_show")
      * @return Response
      */
      public function showSeason(int $seasonId, EpisodeRepository $episoderepository): Response
      {
          $season = $this->getDoctrine()
              ->getRepository(Season::class)
              ->findOneBy(['id' => $seasonId]);
  
          if (!$season) {
              throw $this->createNotFoundException(
                  'No program with id : '.$seasonId.' found in program\'s table/.'
              );
          }

          $episodes = $episoderepository->findBy(['season' => $season]);

          return $this->render('season/show.html.twig', [
              'season' => $season,
              'episodes' => $episodes,
          ]);

        }

}
