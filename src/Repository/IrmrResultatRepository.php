<?php

namespace App\Repository;

use App\Entity\IrmrResultat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method IrmrResultat|null find($id, $lockMode = null, $lockVersion = null)
 * @method IrmrResultat|null findOneBy(array $criteria, array $orderBy = null)
 * @method IrmrResultat[]    findAll()
 * @method IrmrResultat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IrmrResultatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IrmrResultat::class);
    }

    // /**
    //  * @return IrmrResultat[] Returns an array of IrmrResultat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?IrmrResultat
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
