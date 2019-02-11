<?php
namespace App\Controller;

use App\Entity\Korisnici;
use App\Entity\Upisi;
use App\Repository;
use App\Form\RegistrationFormType;
use App\Entity\Predmeti;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\Routing\Annotation\Method;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractControlle;

class StudentController extends AbstractController
{
  /**
  *@Route("/upisnilist", methods={"GET","POST"})
  */
  public function ul(AuthenticationUtils $a,Request $f): Response
  {
    #if za upis predmeta
    #/** @var \App\Entity\Korisnici $user */
    #  $u=new Korisnici();
    #  $u = $this->getUser();
    if($f->isMethod('POST') && is_null($f->request->get('pred'))!= true)
    {
      $upisni=new Upisi();

      $u= $a->getLastUsername();
      $pred=$f->request->get('pred');


      $predmet=$this->getDoctrine()->getRepository(Predmeti::class)->findOneBy(['ime' => $pred]);
      $user=$this->getDoctrine()->getRepository(Korisnici::class)->findOneBy(['email' => $u]);
      $upisni->setStatus('enrolled');
      $upisni->setPredmet($predmet);
      $upisni->setStudent($user);


      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($upisni);
      $entityManager->flush();
    }

    #if za polozi predmet
    $promjeni='';
    if($f->isMethod('POST') && is_null($f->request->get('polozi'))!= true)
    {

      $promjeni=$f->request->get('polozi');
      $ul=$this->getDoctrine()->getRepository(Upisi::class)->find($promjeni);
      $ul->setStatus('passed');
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->flush();

    }
    #if za ispis predmeta
    if($f->isMethod('POST') && is_null($f->request->get('ispisi'))!= true)
    {
        $promjeni=$f->request->get('ispisi');
        $ul=$this->getDoctrine()->getRepository(Upisi::class)->find($promjeni);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($ul);
        $entityManager->flush();


    }

    $u= $a->getLastUsername();
    $user=new Korisnici();
    $predmeti = $this->getDoctrine()->getRepository(Predmeti::class)->findAllOrderedByIme();
    $user=$this->getDoctrine()->getRepository(Korisnici::class)->findOneBy(['email' => $u]);
    $id=$user->getId(); #radi
    $status=$user->getStatus();

    if($status=='redovni')
    {
      $status='semRedovni';
    }
    else {
      $status='semIzvanredni';
    }
      $ul=$this->getDoctrine()->getRepository(Upisi::class)->findAllByStudentIdAndStatus($id);

       return $this->render('nakonprijave/upisnilist.html.twig', [
              'predmeti' => $predmeti,
              'up'=>$ul,
              'status'=>$status,
              'p'=>$promjeni


          ]);

  }

}
