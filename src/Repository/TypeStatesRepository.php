<?php

namespace App\Repository;

use App\Entity\TypeStates;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method TypeStates|null find($id, $lockMode = null, $lockVersion = null)
 * @method TypeStates|null findOneBy(array $criteria, array $orderBy = null)
 * @method TypeStates[]    findAll()
 * @method TypeStates[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TypeStatesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, TypeStates::class);
    }

    // /**
    //  * @return TypeStates[] Returns an array of TypeStates objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?TypeStates
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
