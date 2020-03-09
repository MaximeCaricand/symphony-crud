<?php

namespace App\Repository;

use App\Entity\Ceremonie;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method Ceremonie|null find($id, $lockMode = null, $lockVersion = null)
 * @method Ceremonie|null findOneBy(array $criteria, array $orderBy = null)
 * @method Ceremonie[]    findAll()
 * @method Ceremonie[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CeremonieRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Ceremonie::class);
    }

    // /**
    //  * @return Ceremonie[] Returns an array of Ceremonie objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Ceremonie
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
