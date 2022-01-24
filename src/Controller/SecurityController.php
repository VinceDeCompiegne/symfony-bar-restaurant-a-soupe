<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use App\Form\ChgPwdType;
use App\Form\RegisterType;
use App\Entity\ChgPwd;
use App\Entity\Register;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class SecurityController extends AbstractController
{
    private $passwordEncoder;
    public function __construct(UserPasswordHasherInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    /**
     * @Route("security", name="security")
     */
    public function index(): Response
    {
        return $this->render('security/index.html.twig', [
            'controller_name' => 'SecurityController',
        ]);
    }

    /**
     * @Route("/login", name="app_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        return $this->redirectToRoute("acceuil");
        // throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
    /**
     * @Route("/chgpwd", name="chgpwd")
     */
    public function chgpwd(AuthenticationUtils $authenticationUtils, Request $request): Response
    {
        $user = new User();
        $chgPwd = new ChgPwd();
        $form = $this->createForm(ChgPwdType::class,$chgPwd);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
           // public function isPasswordValid(UserInterface $user, string $raw);
            $oldPwd = $form->get('oldPassword')->getData();
      
            $pwd = $form->get('password')->getData();
            $confpwd = $form->get('ConfirmPassword')->getData();
            if ($pwd != $confpwd) {
                $this->addFlash("message","mot de passe mal ecrit !");
                $message = "mot de passe mal ecrit !";
                return $this->render('security/chgPwd.html.twig', [
                    'form' => $form->createView(),'message'=>$message
                ]);
            }
            $em=$this->getDoctrine()->getManager();

            $repo =$this->getDoctrine()->getRepository(User::class);

            $description = $repo->findOneBy(array('email'=>$form->get('email')->getData()));
      
            if ($description == null) {
                $this->addFlash("message","mail non connu !");
                $message = "mail non connu !";
                return $this->render('security/chgPwd.html.twig', [
                    'form' => $form->createView(),'message'=>$message
                ]);
            }else{
                $user = $description;
            }
            $userold = $this->getDoctrine()->getRepository(User::class)
            ->findOneBy(array('email'=>$form->get('email')->getData()));
                if (!$this->passwordEncoder->isPasswordValid($userold, $oldPwd)){
                    $message = "Ancien mot de passe non valide !";
                    return $this->render('security/chgPwd.html.twig', [
                        'form' => $form->createView(),'message'=>$message
                    ]);
                }
            $user->SetDate(new \datetime());
            $user->setNom($form->get('nom')->getData());
            $user->setPrenom($form->get('prenom')->getData());
            // $user->setEmail($form->get('mail')->getData());
            $user->setPassword($this->passwordEncoder->hashPassword($user, $form->get('password')->getData()));
            $user->setRoles($description->getRoles());
            $em->persist($user);
            $em->flush();
            $this->addFlash("message","message de succés !");

            return $this->redirectToRoute('acceuil');
        
        }
        return $this->render('security/chgpwd.html.twig', [
            'form' => $form->createView(),"message"=>""]
        );
    }


     /**
     * @Route("/register", name="register")
     */
    public function register(AuthenticationUtils $authenticationUtils, Request $request): Response
    {
        
        $register = new Register();
        $form = $this->createForm(RegisterType::class,$register);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
           // public function isPasswordValid(UserInterface $user, string $raw);
                  
           $em=$this->getDoctrine()->getManager();

           $repo =$this->getDoctrine()->getRepository(User::class);

           $description = $repo->findOneBy(array('email'=>$form->get('email')->getData()));
     
           if ($description != null) {
               $this->addFlash("message","mail déjà connu !");
               $message = "mail déjà connu !";
               return $this->render('security/register.html.twig', [
                   'form' => $form->createView(),'message'=>$message
               ]);
           }else{
               $user = $description;
           }

            $pwd = $form->get('password')->getData();
            $confpwd = $form->get('ConfirmPassword')->getData();
            if ($pwd != $confpwd) {
                $message = "mot de passe mal ecrit !";
                return $this->render('security/register.html.twig', [
                    'form' => $form->createView(),'message'=>$message
                ]);
            }
  
            $user = new User();
            $user->SetDate(new \datetime());
            $user->setNom($form->get('nom')->getData());
            $user->setPrenom($form->get('prenom')->getData());
            $user->setEmail($form->get('email')->getData());
            $user->setPassword($this->passwordEncoder->hashPassword($user, $form->get('password')->getData()));
            $user->setRoles(["ROLE_USER"]);
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute('acceuil');
        
        }
        return $this->render('security/register.html.twig', [
            'form' => $form->createView(),"message"=>""]
        );
    }

}
