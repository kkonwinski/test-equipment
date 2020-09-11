<?php

namespace App\Repository;

use App\Entity\Runes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Runes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Runes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Runes[]    findAll()
 * @method Runes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RunesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Runes::class);
    }

    // /**
    //  * @return Runes[] Returns an array of Runes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Runes
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
