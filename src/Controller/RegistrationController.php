<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/register", name="app_register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new User();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password

            /** @var  $uploadFile */
            $uploadFile = $form['image']->getData();

            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('plainPassword')->getData()
                )
            );
            $user->setRoles(["ROLE_USER"]);

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();
            // do anything else you need here, like send an email
            if (!empty($uploadFile)) {


                //dd($uploadFile);
                $destination = $this->getParameter('kernel.project_dir') . '/public/images/profils';
                $addresse = 'images/profils/';
                $newFilename = $user->getUsername() . '-photoProfil.' . $uploadFile->guessExtension();
                //dd($destination.$newFilename);
                //dd($addresse.$utilisateur->getUsername() . '-photoProfil.');
                if(!empty($user->getLinkImage()) ){
                    $fsObject = new Filesystem();
                    //dd($destination.$newFilename);
                    $fsObject->remove($user->getLinkImage());


                }
                $uploadFile->move(
                    $destination,
                    $newFilename
                );
                $user->setLinkImage($addresse.$newFilename);
                $entityManager->persist($user);
                $entityManager->flush();
            }

            return $this->redirectToRoute('home');
        }

        return $this->render('user/register.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
