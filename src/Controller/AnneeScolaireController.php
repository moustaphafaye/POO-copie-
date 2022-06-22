<?php

namespace App\Controller;

use App\Entity\AnneeScolaire;
use App\Form\AnneeScolaireType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AnneeScolaireRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AnneeScolaireController extends AbstractController
{
    #[Route('/annee-scolaire', name: 'app_annee_scolaire')]
    public function index( 
        AnneeScolaireRepository $repo,
        PaginatorInterface $paginator,
        Request $request
    ): Response
    {
        $data=$repo->findAll();
        $anne = $paginator->paginate(
            $data,
            $request->query->getInt('page',1),
            5
        );
        return $this->render('annee_scolaire/index.html.twig', [
            'controller_name' => 'AnneeScolaireController',
            'annee'=>$anne
        ]);
    }
    #[Route('/add-annee', name: 'add_annee')]

    
    public function add_classe(Request $request ,EntityManagerInterface $manager){

        $annee=new AnneeScolaire();
        $form=$this->createForm(AnneeScolaireType::class,$annee  );
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($annee);
            $manager->flush();
            return $this->redirectToRoute('app_classe');
        }
        return $this->render('annee_scolaire/form.html.twig',['form'=>$form->createView()]);

    }
}
