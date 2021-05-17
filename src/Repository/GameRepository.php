<?php

namespace App\Repository;

use App\Entity\Game;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Game|null find($id, $lockMode = null, $lockVersion = null)
 * @method Game|null findOneBy(array $criteria, array $orderBy = null)
 * @method Game[]    findAll()
 * @method Game[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GameRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Game::class);
    }

    // /**
    //  * @return Game[] Returns an array of Game objects
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
    public function findOneBySomeField($value): ?Game
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function findJoin()
    {


        /*   $query = $this
                ->createQueryBuilder('ge')
                ->addSelect('u','ge')
                ->innerJoin('ge.id','ga')
                ->innerJoin('ga.users','u')

           ;*/
        $query = $this
            ->createQueryBuilder('g')
            ->addSelect('h','g')
            ->innerJoin('g.hardware','h')
            ->andWhere('g.hardware = :val')
            ->setParameter('val',33)

        ;
/*        $query = $this
            ->createQueryBuilder('g')
            ->addSelect('ge','g')
            ->innerJoin('g.genre','ge')
            ->innerJoin()

        ;*/
        /*->innerJoin('g.genre','ge');*/
        /*->setParameter('val',6);*/


        dd($query->getQuery()->getResult());

        return $query->getQuery()->getResult();

    }
}
