<?php

namespace App\Repository;

use App\Entity\Genre;
use App\Entity\User;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\This;

/**
 * @method Genre|null find($id, $lockMode = null, $lockVersion = null)
 * @method Genre|null findOneBy(array $criteria, array $orderBy = null)
 * @method Genre[]    findAll()
 * @method Genre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GenreRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Genre::class);
    }

public function findGenreUser(User $currentUser)
{


   $query = $this
        ->createQueryBuilder('g')
        /*->select('ga','ge','u')*/
        /*->andWhere('g like :val')*/
        ->innerJoin('g.games','ga')
        ->innerJoin('ga.users','u')
        ->innerJoin('u.hardwares', 'h')
   ;
        /*->innerJoin('g.genre','ge');*/
        /*->setParameter('val',6);*/


        dd($query->getQuery()->getResult());

    return $query->getQuery()->getResult();

}
}
