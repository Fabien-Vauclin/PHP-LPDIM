<?php

namespace App\Controller;


use App\FakeData;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Game;

class GameController extends AbstractController
{

    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        /**
         * @todo lister les jeux de la base
         */
        $games = $entityManager
            ->getRepository(Game::class)
            ->findAll();

        $games = FakeData::games(15);
        return $this->render("game/index.html.twig", ["games" => $games]);

    }

    public function add(Request $request, EntityManagerInterface $entityManager): Response
    {
        //$game = FakeData::games(1)[0];
        $game = $entityManager->getRepository(Game::class);

        if ($request->getMethod() == Request::METHOD_POST) {
            /**
             * @todo enregistrer l'objet
             */

            $game
                ->setName($request->get('name'))
                ->setImage($request->get('image'));

            $entityManager->persist($game);
            $entityManager->flush();


            return $this->redirectTo("/game");
        }
        return $this->render("game/form.html.twig", ["game" => $game]);
    }


    public function show($id): Response
    {
        $game = FakeData::games(1)[0];
        return $this->render("game/show.html.twig", ["game" => $game]);
    }


    public function edit($id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $game = FakeData::games(1)[0];

        if ($request->getMethod() == Request::METHOD_POST) {
            /**
             * @todo enregistrer l'objet
             */
            $game
                ->setName($request->get('name'))
                ->setImage($request->get('image'));

            $entityManager->persist($game);
            $entityManager->flush();
            return $this->redirectTo("/game");
        }
        return $this->render("game/form.html.twig", ["game" => $game]);


    }

    public function delete($id, EntityManagerInterface $entityManager): Response
    {
        /**
         * @todo supprimer l'objet
         */

        $game = $entityManager->getRepository(Game::class)->find($id);

        $entityManager->remove($game);

        $entityManager->flush();
        return $this->redirectTo("/game");

    }

}