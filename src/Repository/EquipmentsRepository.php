<?php

namespace App\Repository;

use App\Entity\Equipments;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Equipments|null find($id, $lockMode = null, $lockVersion = null)
 * @method Equipments|null findOneBy(array $criteria, array $orderBy = null)
 * @method Equipments[]    findAll()
 * @method Equipments[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EquipmentsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Equipments::class);
    }

    // /**
    //  * @return Equipments[] Returns an array of Equipments objects
    //  */
    public function findByProject($projetid)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.project = :val')
            ->setParameter('val', $projetid)
            ->orderBy('e.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    /*
    public function findOneBySomeField($value): ?Equipments
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
