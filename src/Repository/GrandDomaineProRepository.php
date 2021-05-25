<?php

namespace App\Repository;

use App\Entity\GrandDomainePro;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method GrandDomainePro|null find($id, $lockMode = null, $lockVersion = null)
 * @method GrandDomainePro|null findOneBy(array $criteria, array $orderBy = null)
 * @method GrandDomainePro[]    findAll()
 * @method GrandDomainePro[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GrandDomaineProRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, GrandDomainePro::class);
    }

    // /**
    //  * @return GrandDomainePro[] Returns an array of GrandDomainePro objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?GrandDomainePro
    {
        return $this->createQueryBuilder('g')
            ->andWhere('g.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
