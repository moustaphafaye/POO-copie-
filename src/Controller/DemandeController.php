<?php

namespace App\Controller;

use App\Repository\DemandeRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DemandeController extends AbstractController
{
    #[Route('/demande', name: 'app_demande')]
    public function index(DemandeRepository $repo): Response
    {
        $demand=$repo->findAll();
        return $this->render('demande/index.html.twig', [
            'controller_name' => 'DemandeController',
            'demande'=>$demand
        ]);
    }
}
