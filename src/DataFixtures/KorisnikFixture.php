<?php

namespace App\DataFixtures;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\Korisnici;

class KorisnikFixture extends Fixture
{
       private $passwordEncoder;

     public function __construct(UserPasswordEncoderInterface $passwordEncoder)
     {
         $this->passwordEncoder = $passwordEncoder;
     }
    public function load(ObjectManager $manager)
    {
         $korisnik = new Korisnici();
        // $manager->persist($product);

        $korisnik->setPassword($this->passwordEncoder->encodePassword(
             $korisnik,
             'the_new_password'
         ));
    }
}
