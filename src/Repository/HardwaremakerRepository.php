<?php

namespace App\Repository;

use App\Entity\Hardwaremaker;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Hardwaremaker|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hardwaremaker|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hardwaremaker[]    findAll()
 * @method Hardwaremaker[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HardwaremakerRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hardwaremaker::class);
    }

    // /**
    //  * @return Hardwaremaker[] Returns an array of Hardwaremaker objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Hardwaremaker
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
