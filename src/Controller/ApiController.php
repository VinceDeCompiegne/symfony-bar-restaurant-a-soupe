<?php

namespace App\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\RecetteRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Recette;
use App\Entity\Description;
use App\Entity\Reservation;
use Symfony\Component\Security\Core\User\UserInterface;
use App\Entity\ReservationDetail;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends AbstractController
{
    private $recetteRepository;
    
    public function __construct(RecetteRepository $recetteRepository){
         $this->recetteRepository=$recetteRepository;
    }
    /**
     * @Route("/api/nutriscore/all", name="api1", methods={"GET"})
     */
    public function index(): JsonResponse
    {
        $recetteListe = $this->recetteRepository->findRecetteAll();
  
        $response = new JsonResponse($recetteListe);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/api/detail/recette/{id}", name="api2")
     */
    public function detailRecetteById(int $id): JsonResponse
    {
        $recetteListe = $this->recetteRepository->DetailRecetteById($id);
  
        $response = new JsonResponse($recetteListe);
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }
    /**
     * @Route("/api/liste/image", name="api3")
     */
    public function listeImage(): JsonResponse
    {
        $location=$this->getParameter('kernel.project_dir').'\public\assets\images\recette';
        $fileregex='/\.(png|jpg|jpeg|gif)$/';
        $matchedfiles = array();
    
        $all = opendir($location);
        while ($file = readdir($all)) {
           if (!is_dir($location.'/'.$file)) {
              if (preg_match($fileregex,$file)) {
                 array_push($matchedfiles,$file);
              }
           }
        }
        closedir($all);
        unset($all);


        $response = new JsonResponse($matchedfiles);
        $response->headers->set('Content-Type', 'application/json');
        return $response; 
    }
       
    /**
     * @Route("/api/modifie/recette", name="api4", methods={"GET"})
     */        
    public function modifierRecette(Request $request): JsonResponse
    {
        
        // $recette=json_decode($request->request->get('recette'));
        $recette=json_decode($request->query->get('recette'));

       if ($recette == null){
            $response = new JsonResponse("NOK");
            $response->headers->set('Content-Type', 'application/json');
            return $response; 
        }
        // $recetteListe = $this->recetteRepository->ModifierRecette(1,2,3,4,5,6,7,"test","description","image_16.jpeg",8,9,1);
        
        
        $recetteListe = $this->recetteRepository->ModifierRecette($recette->energy,$recette->fibers,$recette->fruit_percentage,$recette->proteins,$recette->saturated_fats,$recette->sodium,$recette->sugar,$recette->nom,$recette->description,$recette->image,$recette->aime,$recette->prix,$recette->id);
        
        $response = new JsonResponse("OK");
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/api/ajoute/recette", name="api5", methods={"GET"})
     */        
    public function ajouterRecette(Request $request): JsonResponse
    {
              
       $recette=json_decode($request->query->get('recette'));
        
       if ($recette == null){
            $response = new JsonResponse("NOK");
            $response->headers->set('Content-Type', 'application/json');
            return $response; 
        }
        //$recetteAdd = $this->addRecette(1,2,3,4,5,6,7,"test","description","image_16.jpeg",8,9);
        $recetteAdd = $this->addRecette($recette->energy,$recette->fibers,$recette->fruit_percentage,$recette->proteins,$recette->saturated_fats,$recette->sodium,$recette->sugar,$recette->nom,$recette->description,$recette->img,$recette->aime,$recette->prix);
        
        if ($recetteAdd == false){
            $response = new JsonResponse("NOK");
            $response->headers->set('Content-Type', 'application/json');
            return $response; 
        }

        $response = new JsonResponse("OK");
        $response->headers->set('Content-Type', 'application/json');
        return $response;

    }


    public function addRecette(int $energy,
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
        $desc->setactive(1);
        $desc->setaime($aime);
        $desc->setprix($prix);
        $desc->setnom($recette);
        // tell Doctrine you want to (eventually) save the Product (no queries yet)
        $entityManager->persist($desc);
        // actually executes the queries (i.e. the INSERT query)
        $req2 = $entityManager->flush();

        $response = new JsonResponse("OK");
        $response->headers->set('Content-Type', 'application/json');
        return $response;
    }

    /**
     * @Route("/api/ajoute/reservation", name="api6", methods={"GET"})
     */        
    public function addReservation(Request $request): JsonResponse
    {
        
        $reserv=json_decode($request->query->get('reservation'));
  
        //  $response = new Response(var_dump($reserv));
        //  return $response;

        
        if (!isset($reserv)){
            $response = new JsonResponse("NOK : JSON");
            $response->headers->set('Content-Type', 'application/json');
            return $response; 
        }
  
       
        $entityManager = $this->getDoctrine()->getManager();
        
        $reservation = new Reservation();
        $reservation->setDate(new \datetime());
        $users = $this->getUser();
        $reservation->setChck(0);
        $reservation->setEmail($users);

        $entityManager->persist($reservation);

        $entityManager->flush();
        $entityManager->clear();

        $rec = $this->getDoctrine()->getRepository(Recette::class);
        $dec = $this->getDoctrine()->getRepository(Description::class);
        $res = $this->getDoctrine()->getRepository(Reservation::class);
  
        foreach((array) $reserv as $item => $val){

            $reservationDetail = new ReservationDetail();
            
            if ($val->reservation == "1"){
                try{
                    $idProduit = $val->id;
                    $description = $dec->findOneBy(array("id"=>$idProduit));
                    $reservation = $res->findOneBy(array("email"=>$this->getUser(),'date'=>new \datetime()));
                    $newRecette = $rec->findOneBy(array("id"=>$description->getNom()->getId()));
                 
                
                     if(isset($newRecette)){
                        
                        $reservationDetail->setRecette($newRecette);
                        $reservationDetail->setRef($reservation);
                        $reservationDetail->setImage($description);
                        $reservationDetail->setQuantite($val->nombre);

                        $entityManager = $this->getDoctrine()->getManager();
                        $entityManager->persist($reservationDetail);
                        $entityManager->flush();
                        $entityManager->clear();
                        
                    }else{

                        $reponse = new JsonResponse("NOK : Reservation Detail");
                        $reponse->headers->set('Content-Type', 'application/json');
                        return $response;

                    } 
                
                }catch(Exception $err){
                    $response = new JsonResponse($err);
                    $response->headers->set('Content-Type', 'application/json');
                    return $response;
                }
                
            }
            
            if ($val->aime == "1"){
                try{
                    $idProduit = $val->id;
                    $description = $dec->findOneBy(array("id"=>$idProduit));

                    if(isset($description)){
                        
                        $description->setAime($description->getAime()+1);

                        $entityManager = $this->getDoctrine()->getManager();
                        $entityManager->persist($description);
                        $entityManager->flush();
                        $entityManager->clear();
                        
                    }else{

                        $reponse = new JsonResponse("NOK : Aime");
                        $reponse->headers->set('Content-Type', 'application/json');
                        return $response;

                    } 
                
                }catch(Exception $err){
                    $response = new JsonResponse($err);
                    $response->headers->set('Content-Type', 'application/json');
                    return $response;
                }
                
            }
        }
        
        $response = new JsonResponse("OK");
        $response->headers->set('Content-Type', 'application/json');
        return $response;
        
    
    }

}
