<?php
namespace App\Controller;

use App\Entity\Korisnici;
use App\Repository;
use App\Form\RegistrationFormType;
use App\Entity\Predmeti;
use App\Entity\Upisi;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Component\HttpFoundation\RedirectResponse;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractControlle;

class MenController extends AbstractController
{
  /**
  *@Route("/predmeti",name="predmeti")
  *@Security("is_granted('ROLE_MENTOR')")
  */
  public function prikazi_p()
  {

    $predmeti = $this->getDoctrine()->getRepository(Predmeti::class)->findAllOrderedByIme();
       return $this->render('nakonprijave/predmeti.html.twig', [
              'predmeti' => $predmeti,
              's'=>''
          ]);

  }
#/6ectspredmet
/**
*@Route("/6ectspredmet",name="6ectspredmet")
*@Security("is_granted('ROLE_MENTOR')")
*/
public function ects()
{

  $predmeti = $this->getDoctrine()->getRepository(Predmeti::class)->findAllOrderedByEcts();

  $s="";
  if($predmeti==null)
  {
    $s="Nema predmeta sa toliko ects bodova!";
  }

  $upisni=$this->getDoctrine()->getRepository(Upisi::class)->findAll();


     return $this->render('nakonprijave/ects.html.twig', [
            'predmeti' => $predmeti,
            'ul'=>$upisni,
            's'=>$s

        ]);

}

  /**
  *@Route("/opis{id}",name="opis")
  *@Security("is_granted('ROLE_MENTOR')")
  */
  public function opis($id)
  {

      $p= $this->getDoctrine()->getRepository(Predmeti::class)->find($id);
       return $this->render('nakonprijave/predmet.html.twig', [
              'p' => $p
          ]
        );

  }
  /**
  *@Route("/dodajpredmet",name="dodaj",methods={"GET","POST"})
  *@Security("is_granted('ROLE_MENTOR')")
  */
  public function dodaj(Request $r)
  {
      $s='';
    if($r->isMethod('POST'))
    {
      $p=new Predmeti();
      $p->setIme($r->request->get('ime'));
      $p->setKod($r->request->get('kod'));
      $p->setBodovi($r->request->get('bodovi'));
      $p->setSemRedovni($r->request->get('red'));
      $p->setSemIzvanredni($r->request->get('izv'));
      $p->setIzborni($r->request->get('izborni'));
      $p->setProgram($r->request->get('program'));
      $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($p);
      $entityManager->flush();
      $s='Podaci su uspješno spremljeni!';
      $predmeti = $this->getDoctrine()->getRepository(Predmeti::class)->findAllOrderedByIme();

      return $this->render('nakonprijave/predmeti.html.twig', [
             'predmeti' => $predmeti,
             's'=>$s
         ]
       );

    }
    $p=new Predmeti();
    return $this->render('nakonprijave/dodaj.html.twig', [
           'p' => $p,
           's'=>$s

       ]
     );

  }

  /**
  *@Route("/obrisi{id}",name="obrisi",methods={"GET"})
  *@Security("is_granted('ROLE_MENTOR')")
  */
  public function obrisi($id)
  {

      $p= $this->getDoctrine()->getRepository(Predmeti::class)->find($id);
      $ul= $this->getDoctrine()->getRepository(Upisi::class)->findBy(['predmet'=>$id]);
      $entityManager = $this->getDoctrine()->getManager();
      foreach ($ul as $ul) {
              $entityManager->remove($ul);
        }
      $entityManager->flush();
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->remove($p);
      $entityManager->flush();
      $s='Predmet uspjesno obrisan!';
      return new RedirectResponse('http://my-project.test/predmeti');
    #    $predmeti = $this->getDoctrine()->getRepository(Predmeti::class)->findAllOrderedByIme();
    #  return $this->render('nakonprijave/predmeti.html.twig', [
    #         'predmeti' => $predmeti,
    #         's'=>$s
    #     ]
    #   );
  }

  /**
  *@Route({"/edit{id}","/edit"},name="edit",methods={"GET","POST"})
  *@Security("is_granted('ROLE_MENTOR')")
  */
  public function promjeni($id,Request $r)
  {

    $s='';
    if($r->isMethod('POST'))
    {
      if($id==null)
      {
        $p=new Predmeti();
        $p->setIme($r->get('ime'));
        $p->setKod($r->get('kod'));
        $p->setBodovi($r->get('bodovi'));
        $p->setSemRedovni($r->get('red'));
        $p->setSemIzvanredni($r->get('izv'));
        $p->setIzborni($r->get('izborni'));
        $p->setProgram($r->get('program'));
        $entityManager = $this->getDoctrine()->getManager();
          $entityManager->persist($p);
        $entityManager->flush();
        $s='Podaci su uspješno spremljeni!';
      }
      else {


        $p= $this->getDoctrine()->getRepository(Predmeti::class)->find($id);

        $p->setIme($r->get('ime'));
        $p->setKod($r->get('kod'));
        $p->setBodovi($r->get('bodovi'));
        $p->setSemRedovni($r->get('red'));
        $p->setSemIzvanredni($r->get('izv'));
        $p->setIzborni($r->get('izborni'));
        $p->setProgram($r->get('program'));
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->flush();
        $s='Podaci su uspješno spremljeni!';
      }


    }


          $p= $this->getDoctrine()->getRepository(Predmeti::class)->find($id);
           return $this->render('nakonprijave/predmetpromjeni.html.twig', [
                  'p' => $p,
                  's'=>$s
              ]
            );

  }

  /**
  *@Route("/studenti",name="studenti")
  *
  */
  public function list_studente()
  {
        $this->denyAccessUnlessGranted('ROLE_MENTOR', null, 'Ne možete pristupit ovoj stranici!');
    $studenti = $this->getDoctrine()->getRepository(Korisnici::class)->findBy(
    ['role' => 'student']);
       return $this->render('nakonprijave/studenti.html.twig', [
              'studenti' => $studenti
          ]);

  }
  /**
  *@Route("/student{id}",methods={"POST","GET"})
  *@Security("is_granted('ROLE_MENTOR')")
  *
  */
  public function student($id,Request $f)
  {
    if($f->isMethod('POST') && is_null($f->request->get('pred'))!= true)
    {
      $upisni=new Upisi();


      $pred=$f->request->get('pred');


      $predmet=$this->getDoctrine()->getRepository(Predmeti::class)->findOneBy(['ime' => $pred]);
      $user=$this->getDoctrine()->getRepository(Korisnici::class)->find($id);
      $upisni->setStatus('enrolled');
      $upisni->setPredmet($predmet);
      $upisni->setStudent($user);


      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($upisni);
      $entityManager->flush();
    }
    $promjeni='';
    if($f->isMethod('POST') && is_null($f->request->get('polozi'))!= true)
    {

      $promjeni=$f->request->get('polozi');
      $ul=$this->getDoctrine()->getRepository(Upisi::class)->find($promjeni);
      $ul->setStatus('passed');
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->flush();

    }
    if($f->isMethod('POST') && is_null($f->request->get('ispisi'))!= true)
    {
        $promjeni=$f->request->get('ispisi');
        $ul=$this->getDoctrine()->getRepository(Upisi::class)->find($promjeni);

        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($ul);
        $entityManager->flush();


    }
    $user=new Korisnici();

     $user=$this->getDoctrine()->getRepository(Korisnici::class)->find($id);
     $st=$user->getEmail();
     $s=$user->getStatus();
     $upisni = $this->getDoctrine()->getRepository(Upisi::class)->findAllByStudentIdAndStatus($id);
     $predmeti = $this->getDoctrine()->getRepository(Predmeti::class)->findAllOrderedByIme();

     if($s=='redovni')
     {
       $s='semRedovni';
     }
     else {
       $s='semIzvanredni';
     }
        return $this->render('nakonprijave/student.html.twig', [
               'up' => $upisni,
               'predmeti'=> $predmeti,
               'status'=>$s,
               'st'=>$st,
               'id'=>$id

           ]);

  }

}
