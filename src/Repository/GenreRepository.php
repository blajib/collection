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


/*   $query = $this
        ->createQueryBuilder('ge')
        ->addSelect('u','ge')
        ->innerJoin('ge.id','ga')
        ->innerJoin('ga.users','u')

   ;*/
    $query = $this
        ->createQueryBuilder('ge')
        ->addSelect('g','ge')
        ->innerJoin('g.genre','ge')

    ;
        /*->innerJoin('g.genre','ge');*/
        /*->setParameter('val',6);*/


        dd($query->getQuery()->getResult());

    return $query->getQuery()->getResult();

}
}
