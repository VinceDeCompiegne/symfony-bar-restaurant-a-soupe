<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\DescriptionRepository;
use App\Repository\ReservationDetailRepository;
use Doctrine\ORM\EntityManagerInterface;
use App\Entity\ReservationDetail;

class AcceuilController extends AbstractController
{
    private $entityManager;
    private $descriptionRepository;
    private $reservationDetailRepository;
    
    public function __construct(EntityManagerInterface $entityManager, DescriptionRepository $descriptionRepository,ReservationDetailRepository $reservationDetailRepository){
         $this->descriptionRepository=$descriptionRepository;
         $this->reservationDetailRepository=$reservationDetailRepository;
         $this->entityManager = $entityManager;
    }
    /**
     * @Route("/", name="domain")
     * @Route("/acceuil", name="acceuil")
     */
    public function index(): Response
    { 
        $ListeAimeTous = $this->reservationDetailRepository->VousAimezTous();
        $VousLikezTous = $this->descriptionRepository->vousLikez();
        if (($this->getUser())!=null){
        $ListeAime = $this->reservationDetailRepository->VousAimez($this->getUser());
        }else{
            $ListeAime=null; 
        }
        return $this->render('acceuil/index.html.twig', [
            'VousAimezTous'=>$ListeAimeTous,
            'VousLikezTous'=>$VousLikezTous,
            'VousAimez'=>$ListeAime,
        ]);

    }
}
