<?php

namespace App\Controller;


use App\FakeData;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Score;


class ScoreController extends AbstractController
{


    public function index(Request $request): Response
    {
        $scores = FakeData::scores();

        $games = FakeData::games();
        $players = FakeData::players();

        return $this->render("score/index", ["scores" => $scores,
            "games" => $games, "players" => $players]);
    }

    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {

        if ($request->getMethod() == Request::METHOD_POST) {
            $scores = FakeData::scores();
            /**
             * @todo enregistrer l'objet
             */
            $scores
                ->setId($request->get('id'))
                ->setScore($request->get('score'));

            $entityManager->persist((object)$scores);
            $entityManager->flush();
            return $this->redirectTo("/score");
        }
    }

}