<?php

namespace App\Controller;

use App\Entity\Korisnici;
use App\Form\RegistrationFormType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class RegistrationController extends AbstractController
{
    /**
     * @Route("/registracija", name="register")
     */
    public function register(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $user = new Korisnici();
        $form = $this->createForm(RegistrationFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // encode the plain password

            $user->setPassword(
                $passwordEncoder->encodePassword(
                    $user,
                    $form->get('Lozinka')->getData()
                )

            );
            $user->setRole('student');
            $user->setStatus($form->get('Status')->getData());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($user);
            $entityManager->flush();

            // do anything else you need here, like send an email

            return $this->redirectToRoute('prijava');





        }

        return $this->render('registration/register.html.twig', [
            'registrationForm' => $form->createView(),
            'message'=> ''
        ]);
    }
}
