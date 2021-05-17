<?php

namespace App\Controller;

use App\Repository\GenreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        //dd("heeeeeeey");
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
        ]);
    }

    /**
     * @Route ("/test", name="test_join")
     */
    public function testJoin(GenreRepository $gr)
    {
        $user = $this->getUser();
        $t = $gr->findGenreUser($user);
        dd($t);
    }
}
