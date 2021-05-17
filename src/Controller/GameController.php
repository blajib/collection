<?php

namespace App\Controller;

use App\Entity\Game;
use App\Form\GameType;
use App\Others\Messages;
use App\Repository\GameRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * @Route ("/game")
 */
class GameController extends AbstractController
{
    private function getSuccesMessage(Messages $messages){
        return $messages;
    }

    /**
     * @Route("/index", name="index_game")
     */
    public function index(GameRepository $gr, UserRepository $ur): Response
    {

        $gameList = $this->getUser()->getGames();

        return $this->render('game/index.html.twig', [
            'gameList' => $gameList
        ]);
    }

    /**
     * @Route ("/add", name="add_game")
     */
    public function insertGame(Request $request, EntityManagerInterface $em)
    {
        $game = new Game();
        $form = $this->createForm(GameType::class, $game);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()){
/*            try {
                $user = $this->getUser();
                $user->addGame($game);
                $em->persist($user);
                $em->flush();
                $this->addFlash('success','Jeu ajouté');
            }catch (\Exception $e){
                $this->addFlash('error','problème lors de l\'enregistrement du jeux:   ');
            }*/
            $game->setName(strtolower($game->getName()));
            $user = $this->getUser();
            $user->addGame($game);
            $em->persist($user);
            $em->flush();
            $this->addFlash('success','Jeu ajouté');


            return $this->redirectToRoute('add_game');
        }
        return $this->render('game/insert.html.twig',[
           "form" => $form->createView(),
        ]);
    }

    /**
     * @Route ("/remove/{idGame}", name="remove_game")
     */
    public function removeGame($idGame, GameRepository $gr,EntityManagerInterface $em)
    {
        try {
            /*$game = $gr->find($idGame);*/
            $user = $this->getUser();
            $game = $gr->find($idGame);
            //dd($game);
            $user->removeGame($game);
            $em->persist($user);
            $em->flush();
            /*$this->getUser()->removeGame($gr->find($idGame));
            */
            return $this->redirectToRoute("index_game");
        }catch (\Exception $e){

        }
    }
}
