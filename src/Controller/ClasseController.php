<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Form\ClasseType;
use App\Repository\ClasseRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use ContainerN0E6N6A\PaginatorInterface_82dac15;
use Doctrine\Persistence\ObjectManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClasseController extends AbstractController
{
    #[Route('/classe', name: 'app_classe')]
    public function index(
        ClasseRepository $repo,
        PaginatorInterface $paginator,
        Request $request
        ): Response
    {
        $data=$repo->findAll();
        $classes = $paginator->paginate(
            $data,
            $request->query->getInt('page',1),
            5
        );
       // dd($classes);
        return $this->render('classe/index.html.twig', [
            'controller_name' => 'ClasseController',
            'classes' => $classes
        ]);
    }
    #[Route('/add-classe', name: 'add_classe')]
    public function add_classe(Request $request ,EntityManagerInterface $manager){

        $classes=new Classe();
        $form=$this->createForm(ClasseType::class,$classes);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($classes);
            $manager->flush();
          return $this->redirectToRoute('app_classe');
        }
        return $this->render('classe/form.html.twig',['formClasse'=>$form->createView()]);

    }
    #[Route('/classe/{id}',name:'edit_classe')]
    public function edit($id,ClasseRepository $repo,Request $request):Response
    {
       
        $classes=$repo->find($id);
        $form=$this->createForm(ClasseType::class,$classes  );
        
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $repo->add($form->getData(),true);
            return $this->redirectToRoute('app_classe');
        }
        return $this->render('classe/form.html.twig',[
            'formClasse'=>$form->createView()]);
        
    }
    #[Route('/delete/{id}',name:'delete_classe')]
    public function delete(
        ClasseRepository $repo,Classe $classe
        )
    {
       $repo->remove($classe ,true);
        return new Response($this->redirectToRoute('app_classe')) ;

    }


    
}
