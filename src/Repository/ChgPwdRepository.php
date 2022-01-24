<?php

namespace App\Repository;

use App\Entity\ChgPwd;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ChgPwd|null find($id, $lockMode = null, $lockVersion = null)
 * @method ChgPwd|null findOneBy(array $criteria, array $orderBy = null)
 * @method ChgPwd[]    findAll()
 * @method ChgPwd[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ChgPwdRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ChgPwd::class);
    }

    // /**
    //  * @return ChgPwd[] Returns an array of ChgPwd objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?ChgPwd
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
