<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Repository;
use App\Entity\Korisnici;

class SecurityController extends AbstractController
{
    /**
     * @Route("/prijava", name="prijava")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

        /**
         * @Route("/welcome", name="welcome")
         */
        public function nakon(AuthenticationUtils $authenticationUtils): Response
        {
          /** @var \App\Entity\Korisnici $user */
            $u=new Korisnici();
            $u = $this->getUser();


            if($u->getRole()=='mentor')
            {
            return $this->render('nakonprijave/welcome.html.twig');
            }

            if($u->getRole()=='student')
            {
              return $this->render('nakonprijave/welcomeS.html.twig');
            }
          }


                /**
                 * @Route("/odjava")
                 */
                public function odjava(AuthenticationUtils $authenticationUtils): Response
                {

                    return $this->render('pocetna');
                }

}
