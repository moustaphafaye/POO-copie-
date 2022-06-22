<?php

namespace App\Controller;

use DateTime;
use App\Entity\Inscription;
use App\Entity\AnneeScolaire;
use App\Form\InscriptionType;
use App\Repository\InscriptionRepository;
use Doctrine\Persistence\ManagerRegistry;
use App\Repository\AnneeScolaireRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class InscriptionController extends AbstractController
{
    private $regist;
    public function __construct(ManagerRegistry $regist)
    {
        $this->regist=$regist;
    }
    
    #[Route('/inscription', name: 'app_inscription')]
    public function inscription(Request $request,InscriptionRepository $repo,UserPasswordHasherInterface $hasher): Response
    {
        $inscrip=new Inscription();
        $form_inscrir=$this->createForm(InscriptionType::class,$inscrip);
        $form_inscrir->handleRequest($request);
        if($form_inscrir->isSubmitted() && $form_inscrir->isValid()){
            // $repoa=new AnneeScolaireRepository($this->regist);
            // $form_inscrir->getdata()->setAnneeScolaire($repoa->find(3));
            $date = new \DateTime();
            // dd($date->format('Y'));
            $form_inscrir->getData()->getEtudiant()->setMatricule("OOO".$date->format('Y').$date->format('s'));
            $form_inscrir->getData()->getEtudiant()->setlogin("log_etu-".$date->format('s').$date->format('Y').'@gmail.com');
            $inscrip->getEtudiant()->setPassword($hasher->hashPassword($inscrip->getEtudiant(),"passer123"));
            // dd( $form_inscrir->getdata());
            $repo->add($form_inscrir->getData(),true);
            // $manager->persist($classes);
            // $manager->flush();
            return $this->redirectToRoute('app_etudiant');
        } 


        return $this->render('inscription/index.html.twig', [
            'forme'=>$form_inscrir->createView()
        ]);
    }
}
