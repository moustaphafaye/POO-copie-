<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    #[Route('/user', name: 'app_user')]
    public function index(Request $request,UserRepository $repo,UserPasswordHasherInterface $hasher): Response
    {
        $user=new User();

        $form= $this->createForm(UserType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            // $manager->persist($user);
            // $manager->flush();
            $form->getData()->setPassword($hasher->hashPassword($form->getData(),"passer"));
            // dd($form_et->getData());
            $repo->add($form->getData(),true);
          return $this->redirectToRoute('app_classe');
        }
        /* return $this->render('security/registration.html.twig',[
           
        ]); */
        return $this->render('user/create.html.twig', [
                'formClasse'=>$form->createView()
            // 'controller_name' => 'UserController',
            
        ]);
    }


  
}
