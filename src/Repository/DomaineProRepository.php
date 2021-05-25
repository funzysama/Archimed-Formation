<?php

namespace App\Repository;

use App\Entity\DomainePro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method DomainePro|null find($id, $lockMode = null, $lockVersion = null)
 * @method DomainePro|null findOneBy(array $criteria, array $orderBy = null)
 * @method DomainePro[]    findAll()
 * @method DomainePro[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DomaineProRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, DomainePro::class);
    }

    // /**
    //  * @return DomainePro[] Returns an array of DomainePro objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?DomainePro
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
