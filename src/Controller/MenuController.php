<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RecetteRepository;

class MenuController extends AbstractController
{
    private $recetteRepository;

    public function __construct(RecetteRepository $recetteRepository){
        $this->recetteRepository=$recetteRepository;
        
   }
    /**
     * @Route("/menu", name="menu")
     */
    public function index(): Response
    {
        $listePlat = $this->recetteRepository->findRecetteAll();
        
        return $this->render('menu/index.html.twig', [
            'listePlat'=>$listePlat,
        ]);
    }
}
