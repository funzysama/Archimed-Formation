<?php

namespace App\Repository;

use App\Entity\I3PResultat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method I3PResultat|null find($id, $lockMode = null, $lockVersion = null)
 * @method I3PResultat|null findOneBy(array $criteria, array $orderBy = null)
 * @method I3PResultat[]    findAll()
 * @method I3PResultat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class I3PResultatRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, I3PResultat::class);
    }

    // /**
    //  * @return I3PResultat[] Returns an array of I3PResultat objects
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
    public function findOneBySomeField($value): ?I3PResultat
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
