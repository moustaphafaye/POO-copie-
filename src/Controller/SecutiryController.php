<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecutiryController extends AbstractController
{
    #[Route('/', name: 'app_index')]
    public function index(AuthenticationUtils $authenticationUtils): Response
    {
        return $this->redirectToRoute("app_secutiry");
    }

    #[Route('/security', name: 'app_secutiry')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        $error = $authenticationUtils->getLastAuthenticationError();

        if($this->getUser()){
            return $this->redirectToRoute("add_module");
        }

        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('user/index.html.twig', [
            'last_username' =>$lastUsername,
            'error' => $error
        ]);
    }

    #[Route('/connexion', name: 'secutiry_registration')]

    public function registration() {

        $user=new User();

         $form= $this->createForm(RegistrationType::class,$user);

         return $this->render('security/registration.html.twig',[
            'form'=>$form->createView()
         ]);
    }

    #[Route('/logout', name: 'app_logout')]
    public function logout(): void
    {
        // controller can be blank: it will never be called!
        throw new \Exception('Don\'t forget to activate logout in security.yaml');
    }
}
