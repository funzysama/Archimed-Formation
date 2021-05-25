<?php

namespace App\Repository;

use App\Entity\MetierPE;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method MetierPE|null find($id, $lockMode = null, $lockVersion = null)
 * @method MetierPE|null findOneBy(array $criteria, array $orderBy = null)
 * @method MetierPE[]    findAll()
 * @method MetierPE[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class MetierPERepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MetierPE::class);
    }

    // /**
    //  * @return MetierPE[] Returns an array of MetierPE objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('m.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?MetierPE
    {
        return $this->createQueryBuilder('m')
            ->andWhere('m.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
