<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\ReservationDetailRepository;

class ReservationController extends AbstractController
{

    private $reservationDetailRepository;
    
    public function __construct(ReservationDetailRepository $reservationDetailRepository){

         $this->reservationDetailRepository=$reservationDetailRepository;

    }

    /**
     * @Route("/reservation", name="reservation")
     */
    public function index(): Response
    {

        $LastCmd = $this->reservationDetailRepository->detailCommande($this->getUser());

        return $this->render('reservation/index.html.twig', [
            'detailLastCmd'=>$LastCmd
        ]);
    }
}
