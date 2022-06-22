<?php

namespace App\Controller;

use App\Entity\Module;
use App\Form\ModuleType;
use App\Repository\ModuleRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ModuleController extends AbstractController
{
    #[Route('/module', name: 'app_module')]
    public function index(
        ModuleRepository $repo,
        PaginatorInterface $paginator,
        Request $request                  ): Response
    {
        $data=$repo->findAll();
        $mod=$paginator->paginate(
            $data,
            $request->query->getInt('page',1),
            5
        );
        return $this->render('module/index.html.twig', [
            'controller_name' => 'ModuleController',
            'module'=>$mod
        ]);
    }
    #[Route('/add-module',name: 'add_module')]
    public function add_module(Request $request ,EntityManagerInterface $manager){
        $mod=new Module();
        $form=$this->createForm(ModuleType::class,$mod);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid()){
            $manager->persist($mod);
            $manager->flush();
          return $this->redirectToRoute('app_module');
        }
        return $this->render('module/form.html.twig',['form'=>$form->createView()]);


    }
}
