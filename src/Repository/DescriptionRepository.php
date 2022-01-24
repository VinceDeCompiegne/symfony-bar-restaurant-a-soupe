<?php

namespace App\Repository;

use App\Entity\Recette;
use App\Entity\Description;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Description|null find($id, $lockMode = null, $lockVersion = null)
 * @method Description|null findOneBy(array $criteria, array $orderBy = null)
 * @method Description[]    findAll()
 * @method Description[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DescriptionRepository extends ServiceEntityRepository
{
    private $EntityManagerInterface;
    
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Description::class);

    }

    // /**
    //  * @return Description[] Returns an array of Description objects
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
    public function findOneBySomeField($value): ?Description
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function vousLikez()
    {
        return $this->createQueryBuilder('d')
            ->where('d.active=1')
            ->orderBy('d.aime', 'desc')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult()
        ;
    }
    public function listePlat()
    {
        return $this->createQueryBuilder('recette')
            ->orderBy('recette.id', 'desc')
            ->getQuery()
            ->getResult()
        ;
    }

public function active(int $id)
{
    return $this->createQueryBuilder('description')
        ->update(Description::class,'description')
        ->set('description.active', 1)
        ->where('description.nom=:id')
        ->setParameter(':id',$id)
        ->getQuery()
        ->getResult()
    ;
}

public function desactive(int $id)
{

        return $this->createQueryBuilder('description')
        ->update(Description::class,'description')
        ->set('description.active', 0)
        ->where('description.nom=:id')
        ->setParameter(':id',$id)
        ->getQuery()
        ->getResult()
    ;
}

public function supprime(int $id)
{

    $req1 =  $this->createQueryBuilder('d')
        ->delete(Description::class,'Description')
        ->WHERE('Description.nom=:id')
        ->setParameter(':id',$id)
        ->getQuery()
        ->getResult()
    ;
    
    $req2 = $this->createQueryBuilder('r')
    ->delete(Recette::class,'recette')
    ->where('recette.id=:id')
    ->setParameter(':id',$id)
    ->getQuery()
    ->getResult();
;
    return ($req1);
}



}




