<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\RequestStack;
use App\Repository\DescriptionRepository;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\Description;

class AdminController extends AbstractController
{
    private $userRepository;
    private $requestStack;
    private $descriptionRepository;
    private $authenticationUtils;

    public function __construct(UserRepository $userRepository,
     RequestStack $requestStack,
     DescriptionRepository $descriptionRepository,
     AuthenticationUtils $authenticationUtils)
     {
         $this->userRepository=$userRepository;
         $this->requestStack = $requestStack;
         $this->descriptionRepository=$descriptionRepository;
         $this->authenticationUtils = $authenticationUtils;
    }
    /**
     * @Route("/admin", name="admin")
     */
    public function index(AuthenticationUtils $authenticationUtils): Response
    {

        // $session = $this->requestStack->getSession();
        // $SessionAdmin = $session->get('userType');
        // if ($SessionAdmin!='admin'){
        //     return $this->redirect('acceuil');
        // }
        // $session->set('userType', '');
        
        $listePlat = $this->descriptionRepository->listePlat();
        $lastUsername = $authenticationUtils->getLastUsername();
        return $this->render('admin\index.html.twig', [
            'controller_name'=> $lastUsername,
            'liste'=>$listePlat,
        ]);

    }

    /**
     * @Route("/admin/active", name="active")
     */
    public function active(Request $request): Response
    {

        $active=$request->get('active');
        $desactive=$request->get('desactive');

        $entityManager = $this->getDoctrine()->getManager();
        $repo =$this->getDoctrine()->getRepository(Description::class);

        if($active!=null){
 
            $description = $repo->findOneBy(array('id'=>$active));
            $description->setActive(1);  

        }else if($desactive!=null){
           
            $description = $repo->findOneBy(array('id'=>$desactive));
            $description->setActive(0);  

        }
        
        $entityManager->persist($description);
        $entityManager->flush();



        // $session->set('userType', '');
        //  $listePlat = $this->descriptionRepository->listePlat();

        // return $this->render('admin\index.html.twig', [
        //     'controller_name'=> "active=" . $active . " - desactive=" . $desactive,
        //     'liste'=>$listePlat,
        // ]);
        return $this->redirectToRoute('admin');
    }

    /**
     * @Route("/admin/supprime", name="supprimer")
     */
    public function supprimer(Request $request): Response
    {
        
        $id=$request->get('supprimer');

        $entityManager = $this->getDoctrine()->getManager();
        $repo =$this->getDoctrine()->getRepository(Description::class);

        if($id!=null){
            $description = $repo->findOneBy(array('id'=>$id));
            $entityManager->remove($description);   
        }
               
        $entityManager->flush();

        // $session->set('userType', '');
        // $listePlat = $this->descriptionRepository->listePlat();

        // return $this->render('admin\index.html.twig', [
        //     'controller_name'=> 'id='.$id,
        //     'liste'=>$listePlat,
        // ]);
        
        return $this->redirectToRoute('admin');
    }
}
