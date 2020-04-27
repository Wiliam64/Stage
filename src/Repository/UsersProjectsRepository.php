<?php

namespace App\Repository;

use App\Entity\UsersProjects;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method UsersProjects|null find($id, $lockMode = null, $lockVersion = null)
 * @method UsersProjects|null findOneBy(array $criteria, array $orderBy = null)
 * @method UsersProjects[]    findAll()
 * @method UsersProjects[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class UsersProjectsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, UsersProjects::class);
    }

    // /**
    //  * @return UsersProjects[] Returns an array of UsersProjects objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('u.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?UsersProjects
    {
        return $this->createQueryBuilder('u')
            ->andWhere('u.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
