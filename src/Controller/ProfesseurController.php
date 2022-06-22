<?php

namespace App\Controller;

use App\Entity\Professeur;
use App\Form\ProfesseurType;
use App\Repository\ClasseRepository;
use App\Repository\ProfesseurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfesseurController extends AbstractController
{
    #[Route('/professeur', name: 'app_professeur')]
    public function index(
        ProfesseurRepository $repo,
        PaginatorInterface $paginator,
        Request $request
        ): Response
    { 
        $data=$repo->findAll();
        $profs=$paginator->paginate($data,$request->query->getInt('page',1),6);
        return $this->render('professeur/index.html.twig', [
            'controller_name' => 'ProfesseurController',
            'professeur' => $profs
        ]);
    }
    #[Route('/add_professeur', name: 'add_professeur')]
    #[Route('/edit_professeur/{id}', name: 'edit_professeur')]

    public function add_professeur( ClasseRepository $classe,Professeur $prof=null,Request $request ,EntityManagerInterface $manager){
        if(!$prof){
        $prof=new Professeur();
        }
        $classes=$classe->findAll();
        //dd($classes);
        $forme=$this->createForm(ProfesseurType::class,$prof  );
        $forme->handleRequest($request);
        if($forme->isSubmitted() && $forme->isValid()){
            $forme->getdata();
            $manager->persist($prof);
            $manager->flush();
          return $this->redirectToRoute('app_professeur',['id'=>$prof->getId()]);
        }
        return $this->render('professeur/form.html.twig',
                            [   'form'=>$forme->createView(),
                                'edit'=>$prof->getId()!==null,
                                'classe'=>$classes
                            ]);


    }
    // #[Route('/delete/{id}',name:'delete_profeseur')]
    // public function delete(
    //     ProfesseurRepository $repo,Professeur $prof
    //     )
    // {
    //    $repo->remove($prof ,true);
    //     return new Response($this->redirectToRoute('app_professeur'));

    // }
    // #[Route('/edit_professeur/{id}', name: 'edit_professeur')]
    // public function edit($id,ProfesseurRepository $repo,Request $request):Response
    // {
       
    //     $professeur=$repo->find($id);
    //     $form=$this->createForm(ProfesseurType::class,$professeur  );
        
    //     $form->handleRequest($request);
    //     if($form->isSubmitted() && $form->isValid()){
    //         $repo->add($form->getData(),true);
    //         return $this->redirectToRoute('app_professeur');
    //     }
    //     return $this->render('professeur/form.html.twig',[
    //         'form'=>$form->createView()]);
        
    // }

}




