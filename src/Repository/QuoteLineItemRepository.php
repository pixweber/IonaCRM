<?php

namespace App\Repository;

use App\Entity\QuoteLineItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Common\Persistence\ManagerRegistry;

/**
 * @method QuoteLineItem|null find($id, $lockMode = null, $lockVersion = null)
 * @method QuoteLineItem|null findOneBy(array $criteria, array $orderBy = null)
 * @method QuoteLineItem[]    findAll()
 * @method QuoteLineItem[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class QuoteLineItemRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, QuoteLineItem::class);
    }

    // /**
    //  * @return QuoteLineItem[] Returns an array of QuoteLineItem objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('q.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?QuoteLineItem
    {
        return $this->createQueryBuilder('q')
            ->andWhere('q.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
