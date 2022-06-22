<?php

namespace App\Controller;

use App\Entity\Etudiant;
use App\Form\EtudiantType;
use App\Repository\EtudiantRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class EtudiantController extends AbstractController
{
    #[Route('/etudiant', name:'app_etudiant')]
    public function index(
        EtudiantRepository $repo,
        PaginatorInterface $paginator,
        Request $request
        ): Response
    {
        $data=$repo->findAll();
        $etude=$paginator->paginate(
            $data,
            $request->query->getInt('page',1),5
        );
        return $this->render('etudiant/index.html.twig', [
            'controller_name' => 'EtudiantController',
            'etudiant'=>$etude
        ]);
    }
    #[Route('/add-etudiant', name: 'add_etudiant')]
    public function add_etudaint(Request $request,EtudiantRepository $repo,UserPasswordHasherInterface $hasher){
        $etudiant=new Etudiant();
        $form_et=$this->createForm(EtudiantType::class,$etudiant);
        $form_et->handleRequest($request);
        if($form_et->isSubmitted() && $form_et->isValid()){
            $form_et->getData()->setPassword($hasher->hashPassword($form_et->getData(),"passer"));
            // dd($form_et->getData());
            $repo->add($form_et->getData(),true);
          return $this->redirectToRoute('app_etudiant');
        }
        return $this->render('etudiant/form.html.twig',['forme'=>$form_et->createView()]);

    }

}
