<?php

namespace App\Repository;

use App\Entity\States;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method States|null find($id, $lockMode = null, $lockVersion = null)
 * @method States|null findOneBy(array $criteria, array $orderBy = null)
 * @method States[]    findAll()
 * @method States[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class StatesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, States::class);
    }

    
    public function findByProject($projetid)
    {
        return $this->createQueryBuilder('s')
            ->leftJoin('s.Equipment', 'e')
            ->andWhere('e.project = :val')
            ->setParameter('val', $projetid)
            ->orderBy('s.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }

    
    public function findMaxGroup($projetid)
    {
        return $this->createQueryBuilder('s')
                ->leftJoin('s.Equipment', 'e')
                ->select('(COALESCE(MAX(s.groupe)) + 1) AS max_groupe')
                ->andWhere('e.project = :val')
                ->setParameter('val', $projetid)
                ->groupBy('e.project')
                ->getQuery()
                ->getOneOrNullResult()["max_groupe"];
    }

    public function findEquipementsByGroup($projetid, $groupe)
    {
        return $this->createQueryBuilder('s')
            ->leftJoin('s.Equipment', 'e')
            ->andWhere('e.project = :val')
            ->setParameter('val', $projetid)
            ->andWhere('s.groupe = :grp')
            ->setParameter('grp', $groupe)
            ->orderBy('s.id', 'ASC')
            ->getQuery()
            ->getResult()
        ;
    }
    
}
