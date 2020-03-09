<?php

namespace App\Repository;

use App\Entity\Gagner;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Gagner|null find($id, $lockMode = null, $lockVersion = null)
 * @method Gagner|null findOneBy(array $criteria, array $orderBy = null)
 * @method Gagner[]    findAll()
 * @method Gagner[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GagnerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Gagner::class);
    }

    // /**
    //  * @return Gagner[] Returns an array of Gagner objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Gagner
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
