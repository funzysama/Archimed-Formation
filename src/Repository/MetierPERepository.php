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

    /**
      * @return MetierPE[] Returns an array of MetierPE objects
      */

    public function findByRiasec($riasecMajeur, $riasecMineur)
    {
         $qb = $this->createQueryBuilder('m')
                ->select()
                ->orderBy('m.code', 'ASC');
         if($riasecMajeur){
             $qb->andWhere('m.riasecMajeur = :riasecMaj')
                ->setParameter('riasecMaj', $riasecMajeur);
         }
         if($riasecMineur){
             $qb->andWhere('m.riasecMineur = :riasecMin')
                 ->setParameter('riasecMin', $riasecMineur);
         }

         $query = $qb->getQuery();

         return $query->execute();
    }


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
