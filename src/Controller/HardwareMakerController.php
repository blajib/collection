<?php

namespace App\Controller;

use App\Entity\Hardware;
use App\Entity\Hardwaremaker;
use App\Form\HardwareMakerType;
use App\Form\HardwareType;
use App\Repository\HardwaremakerRepository;
use App\Repository\HardwareRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route ("/hardwareMaker")
 */
class HardwareMakerController extends AbstractController
{
    /**
     * @Route("/index", name="index_hardwareMaker")
     */
    public function index(HardwaremakerRepository $hmr): Response
    {

        $hardMakerList = $hmr->findAll();

        return $this->render('hardwaremaker/index.html.twig', [
            'hardMakerList' => $hardMakerList
        ]);
    }

    /**
     * @Route ("/add", name="add_hardwareMaker")
     */
    public function insertHardwareMaker(Request $request, EntityManagerInterface $em)
    {
        $hardwareMaker = new Hardwaremaker();
        $form = $this->createForm(HardwareMakerType::class, $hardwareMaker);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $hardwareMaker->setName(strtolower($hardwareMaker->getName()));

            $em->persist($hardwareMaker);
            $em->flush();
            $this->addFlash('success', 'Consolier ajouté');


            return $this->redirectToRoute('add_hardwareMaker');
        }
        return $this->render('hardwareMaker/insert.html.twig', [
            "form" => $form->createView(),
        ]);

    }
}
