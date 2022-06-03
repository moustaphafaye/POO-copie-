<?php

namespace App\Controller;

use App\Repository\EtudiantRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EtudiantController extends AbstractController
{
    #[Route('/etudiant', name: 'app_etudiant')]
    public function index(EtudiantRepository $repo): Response
    {
        $etude=$repo->findAll();
        return $this->render('etudiant/index.html.twig', [
            'controller_name' => 'EtudiantController',
            'etudiant'=>$etude
        ]);
    }
}
