<?php

namespace App\Repository;

use App\Entity\I3pProfils;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method I3pProfils|null find($id, $lockMode = null, $lockVersion = null)
 * @method I3pProfils|null findOneBy(array $criteria, array $orderBy = null)
 * @method I3pProfils[]    findAll()
 * @method I3pProfils[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class I3pProfilsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, I3pProfils::class);
    }

    // /**
    //  * @return I3pProfils[] Returns an array of I3pProfils objects
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
    public function findOneBySomeField($value): ?I3pProfils
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
