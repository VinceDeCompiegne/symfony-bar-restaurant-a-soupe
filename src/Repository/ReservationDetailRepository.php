<?php

namespace App\Repository;

use App\Entity\ReservationDetail;
use App\Entity\Description;
use App\Entity\Recette;
use App\Entity\User;
use App\Entity\Reservation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method ReservationDetail|null find($id, $lockMode = null, $lockVersion = null)
 * @method ReservationDetail|null findOneBy(array $criteria, array $orderBy = null)
 * @method ReservationDetail[]    findAll()
 * @method ReservationDetail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReservationDetailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, ReservationDetail::class);
    }

    // /**
    //  * @return ReservationDetail[] Returns an array of ReservationDetail objects
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
    public function findOneBySomeField($value): ?ReservationDetail
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
    public function VousAimezTous()
    {
        
        return $this->createQueryBuilder('r')
        ->groupBy('r.recette')
        ->orderBy('SUM(r.quantite)', 'desc')
        ->setMaxResults(3)
        ->getQuery()
        ->getResult();

    }

    public function VousAimez(User $user)
    {
        
        return $this->createQueryBuilder('r')
        ->join(Reservation::class,'reservation')
        ->groupBy('r.recette')
        ->orderBy('SUM(r.quantite)', 'desc')
        ->where('reservation.email='.$user->getId())
        ->andwhere('r.ref=reservation.id')
        ->setMaxResults(3)
        ->getQuery()
        ->getResult();
        
    }

    public function detailCommande(User $user)
    {
        

        $reservation = $this->createQueryBuilder('m')
        ->join(Reservation::class,'reservation')
        ->where('reservation.email='.$user->getId())
        ->andwhere('m.ref=reservation.id')
        ->orderBy('reservation.date', 'desc')
        ->setMaxResults(1)
        ->getQuery()
        ->getOneOrNullResult();

        if($reservation == null){return 0;}

        return $this->createQueryBuilder('r')
        ->where('r.ref='.$reservation->getRef()->getId())
        // ->setMaxResults(1)
        ->getQuery()
        ->getResult();
        // "SELECT reservation_detail.*, description.prix,(reservation_detail.quantite*description.prix) as result FROM reservation_detail join description WHERE reservation_detail.id = :id AND (description.nom = reservation_detail.recette);
        
    }

}
