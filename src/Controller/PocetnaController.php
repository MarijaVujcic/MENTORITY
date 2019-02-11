<?php
namespace App\Controller;

use App\Entity\Korisnici;
use Symfony\Component\Form\Extensions\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class PocetnaController extends AbstractController
{
  /**
  *@Route("/", name="pocetna")
  *@Method({"GET"})
  *
  **/
  public function index()
  {

    /** @var \App\Entity\Korisnici $user */
   $user = $this->getUser();
   if($user==null)
   {
     return $this->render('pocetna.html.twig');
   }
   else {
     if($user->getRole()=='mentor')
     {
        return $this->render('nakonprijave/welcome.html.twig');

     }
     else {
       return $this->render('nakonprijave/welcomeS.html.twig');


     }
   }


  }



}
