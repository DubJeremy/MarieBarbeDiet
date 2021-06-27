<?php

namespace App\Repository;

use App\Entity\BookingType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method BookingType|null find($id, $lockMode = null, $lockVersion = null)
 * @method BookingType|null findOneBy(array $criteria, array $orderBy = null)
 * @method BookingType[]    findAll()
 * @method BookingType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BookingTypeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, BookingType::class);
    }

    // /**
    //  * @return BookingType[] Returns an array of BookingType objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?BookingType
    {
        return $this->createQueryBuilder('b')
            ->andWhere('b.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
