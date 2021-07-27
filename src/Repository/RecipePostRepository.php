<?php

namespace App\Repository;

use App\Entity\RecipePost;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method RecipePost|null find($id, $lockMode = null, $lockVersion = null)
 * @method RecipePost|null findOneBy(array $criteria, array $orderBy = null)
 * @method RecipePost[]    findAll()
 * @method RecipePost[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecipePostRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, RecipePost::class);
    }
    public function findByAll()
    {
        return $this->findBy([], ['createdAt' => 'DESC']);
    }

    /**
     * @return RecipePost[] Returns an array of RecipePost objects
     */
    public function findByCategory($category)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.userCategory = :val')
            ->setParameter('val', $category)
            ->orderBy('r.id', 'DESC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    

    /*
    public function findOneBySomeField($value): ?RecipePost
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
