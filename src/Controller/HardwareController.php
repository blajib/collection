<?php

namespace App\Controller;

use App\Entity\Game;
use App\Entity\Hardware;
use App\Form\GameType;
use App\Form\HardwareType;
use App\Repository\HardwareRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route ("/hardware")
 */
class HardwareController extends AbstractController
{
    /**
     * @Route("/index", name="index_hardware")
     */
    public function index(HardwareRepository $hr): Response
    {

        $user = $this->getUser();
        $hardList = $user->getHardwares();

        return $this->render('hardware/index.html.twig', [
            'hardList' => $hardList
        ]);
    }

    /**
     * @Route ("/add", name="add_hardware")
     */
    public function insertHardware(Request $request, EntityManagerInterface $em)
    {
        $hardware = new Hardware();
        $form = $this->createForm(HardwareType::class, $hardware);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $hardware->setName(strtolower($hardware->getName()));
            $user = $this->getUser();
            $user->addHardware($hardware);
            $em->persist($user);
            $em->flush();
            $this->addFlash('success', 'Console ajouté');


            return $this->redirectToRoute('add_hardware');
        }
        return $this->render('hardware/insert.html.twig', [
            "form" => $form->createView(),
        ]);

    }
}
