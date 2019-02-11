<?php

namespace App\Repository;

use App\Entity\Korisnici;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Korisnici|null find($id, $lockMode = null, $lockVersion = null)
 * @method Korisnici|null findOneBy(array $criteria, array $orderBy = null)
 * @method Korisnici[]    findAll()
 * @method Korisnici[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class KorisniciRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Korisnici::class);
    }
  
    public function findStudents()
    {
      return $this->getEntityManager()
          ->createQuery(
              'SELECT k FROM App:Korisnici k WHERE  k.roles=student'
          )
          ->getResult();

    }

    // /**
    //  * @return Korisnici[] Returns an array of Korisnici objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('k.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Korisnici
    {
        return $this->createQueryBuilder('k')
            ->andWhere('k.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
