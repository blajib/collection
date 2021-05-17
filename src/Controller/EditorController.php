<?php

namespace App\Controller;

use App\Entity\Editor;
use App\Form\EditorType;
use App\Repository\EditorRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route ("/editor")
 */
class EditorController extends AbstractController
{
    /**
     * @Route("/index", name="index_editor")
     */
    public function index(EditorRepository $er): Response
    {

        $editorList = $er->findAll();

        return $this->render('editor/index.html.twig', [
            'editorList' => $editorList
        ]);
    }

    /**
     * @Route ("/add", name="add_editor")
     */
    public function insertEditor(Request $request, EntityManagerInterface $em)
    {
        $editor = new Editor();
        $form = $this->createForm(EditorType::class, $editor);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $editor->setName(strtolower($editor->getName()));

            $em->persist($editor);
            $em->flush();
            $this->addFlash('success', 'Editeur ajouté');


            return $this->redirectToRoute('add_editor');
        }
        return $this->render('editor/insert.html.twig', [
            "form" => $form->createView(),
        ]);

    }
}
