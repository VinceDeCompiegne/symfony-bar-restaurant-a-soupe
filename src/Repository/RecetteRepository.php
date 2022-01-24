<?php

namespace App\Repository;

use App\Entity\Recette;
use App\Entity\Description;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\ORM\EntityManagerInterface;


/**
 * @method Recette|null find($id, $lockMode = null, $lockVersion = null)
 * @method Recette|null findOneBy(array $criteria, array $orderBy = null)
 * @method Recette[]    findAll()
 * @method Recette[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class RecetteRepository extends ServiceEntityRepository
{
    private $em;

    public function __construct(ManagerRegistry $registry,EntityManagerInterface $em)
    {
        parent::__construct($registry, Recette::class);
        $this->em = $em;
    }

    // /**
    //  * @return Recette[] Returns an array of Recette objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Recette
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    // public function getNom($value):string
    // {
    //     return $this->createQueryBuilder('r')
    //         ->select('nom')
    //         ->andWhere('r.nom_id = :val')
    //         ->setParameter('val', $value)
    //         ->setMaxResults(1)
    //         ->getQuery()
    //         ->getResult()
    //     ;
    // }
 

    public function findRecetteAll()
    {
        return $this->createQueryBuilder('r')
            ->select('DISTINCT d.id,r.nom,r.energy,r.fibers,r.fruit_pourcentage,r.proteins,r.satured_fats,r.sodium,r.sugar,d.prix,d.image,d.description')
            ->innerJoin(Description::class,'d')
            ->WHERE ('d.active = 1')
            ->ANDWHERE ('d.nom = r')
            ->orderBy('r.nom', 'desc')
            ->getQuery()
            ->getresult()
        ;
    }

    public function findRecetteByNom($nom)
    {
        return $this->createQueryBuilder('r')
            ->select('DISTINCT r.nom,r.energy,r.fibers,r.fruit_pourcentage,r.proteins,r.satured_fats,r.sodium,r.sugar,d.image')
            ->innerJoin(Description::class,'d')
            ->WHERE('r.nom = :nom')
            ->ANDWHERE ('d.nom = r')
            ->orderBy('r.nom')
            ->setParameter(':nom',$nom)
            ->getQuery()
            ->getOneOrNullResult();
        ;
    }

    public function DetailRecetteById(int $id)
    {
        return $this->createQueryBuilder('r')
            ->select('DISTINCT r.nom,r.energy,r.fibers,r.fruit_pourcentage,r.proteins,r.satured_fats,r.sodium,r.sugar,r.id,d.image,d.description,d.prix,d.aime')
            ->innerJoin(Description::class,'d')
            ->WHERE('d.nom = :id')
            ->ANDWHERE('r = d.nom')
            ->orderBy('r.nom')
            ->setParameter(':id',$id)
            ->getQuery()
            ->getOneOrNullResult();
        ;
    }

   
    public function ModifierRecette(int $energy,
    int $fibers,
     int $fruit_pourcentage,
     int $proteins,
     int $satured_fats,
     int $sodium,
     int $sugar,
     string $nom,
     string $description,
     string $image,
     int $aime,
     int $prix,
     int $id)
    {
        $req1 =  $this->createQueryBuilder('r')
            ->update(Recette::class,'r')
            ->set('r.energy',':energy')
            ->set('r.fibers',':fibers')
            ->set('r.fruit_pourcentage',':fruit_pourcentage')
            ->set('r.proteins',':proteins')
            ->set('r.satured_fats', ':satured_fats')
            ->set('r.sodium', ':sodium')
            ->set('r.sugar', ':sugar')
            ->set('r.nom', ':nom')
            ->andWhere('r.id=:id')
            ->setParameter(':energy',$energy)
            ->setParameter(':fibers',$fibers)
            ->setParameter(':fruit_pourcentage',$fruit_pourcentage)
            ->setParameter(':proteins',$proteins)
            ->setParameter(':satured_fats',$satured_fats)
            ->setParameter(':sodium',$sodium)
            ->setParameter(':sugar',$sugar)
            ->setParameter(':nom',$nom)
             ->setParameter(':id',$id)
            ->getQuery()
            ->getResult()
        ;

        $req2 =  $this->createQueryBuilder('d')
        ->update(Description::class,'d')
        ->set('d.prix', ':prix')
        ->set('d.aime', ':aime')
        ->set('d.image', ':image')
        ->set('d.description', ':description')
        ->where('d.nom=:id')
        ->setParameter(':description',$description)
        ->setParameter(':aime',$aime)
        ->setParameter(':image',$image)
        ->setParameter(':prix',$prix)
        ->setParameter(':id',$id)
        ->getQuery()
        ->getResult()
    ;

    return ($req1 && $req2);
    }

public function ajouterRecette(int $energy,
    int $fibers,
     int $fruit_pourcentage,
     int $proteins,
     int $satured_fats,
     int $sodium,
     int $sugar,
     string $nom,
     string $description,
     string $image,
     int $aime,
     int $prix)



    {
        $entityManager = $this->getDoctrine()->getManager();

        $recette = new Recette();
        $recette->setenergy($energy);
        $recette->setfibers($fibers);
        $recette->setfruitPourcentage($fruit_pourcentage);
        $recette->setproteins($proteins);
        $recette->setsaturedFats($satured_fats);
        $recette->setSodium($sodium);
        $recette->setsugar($sugar);
        $recette->setnom($nom);
        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($recette);
        // actually executes the queries (i.e. the INSERT query)
        $req1 = $entityManager->flush();

        $desc = new Description();
        $desc->setdescription($description);
        $desc->setimage($image);
        $desc->setaime($aime);
        $desc->setprix($prix);
        $desc->setnom($recette);
        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($desc);
        // actually executes the queries (i.e. the INSERT query)
        $req2 = $entityManager->flush();

    //     $req1 =  $this->createQueryBuilder('r')
    //         ->insertInto('r')
    //         ->setValue('r.energy',':energy')
    //         ->setValue('r.fibers',':fibers')
    //         ->setValue('r.fruit_pourcentage',':fruit_pourcentage')
    //         ->setValue('r.proteins',':proteins')
    //         ->setValue('r.satured_fats', ':satured_fats')
    //         ->setValue('r.sodium', ':sodium')
    //         ->setValue('r.sugar', ':sugar')
    //         ->setValue('r.nom', ':nom')
    //         ->andWhere('r.id=:id')
    //         ->setParameter(':energy',$energy)
    //         ->setParameter(':fibers',$fibers)
    //         ->setParameter(':fruit_pourcentage',$fruit_pourcentage)
    //         ->setParameter(':proteins',$proteins)
    //         ->setParameter(':satured_fats',$satured_fats)
    //         ->setParameter(':sodium',$sodium)
    //         ->setParameter(':sugar',$sugar)
    //         ->setParameter(':nom',$nom)
    //          ->setParameter(':id',$id)
    //         ->getQuery()
    //         ->getResult()
    //     ;

    //     $req2 =  $this->createQueryBuilder('d')
    //     ->insert(Description::class,'d')
    //     ->set('d.prix', ':prix')
    //     ->set('d.aime', ':aime')
    //     ->set('d.image', ':image')
    //     ->set('d.description', ':description')
    //     ->where('d.nom=:id')
    //     ->setParameter(':description',$description)
    //     ->setParameter(':aime',$aime)
    //     ->setParameter(':image',$image)
    //     ->setParameter(':prix',$prix)
    //     ->setParameter(':id',$id)
    //     ->getQuery()
    //     ->getResult()
    // ;

    return ($req1 && $req2);
    }
}
