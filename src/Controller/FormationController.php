<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Formation;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormationController extends AbstractController
{
    #[Route('/formation', name: 'app_formation')]

    public function index(ManagerRegistry $doctrine): Response
    {
        // je recupere toutes les formations de la bdd
        $formations= $doctrine->getRepository(Formation::class)->findAll();
        return $this->render('formation/index.html.twig', [
            'formations' => $formations,
        ]);
    }

    #[Route('/formation/{id}', name: 'show_formation')]
    public function show (ManagerRegistry $doctrine, Formation $formation, Session $session): Response
    {
        return $this->render('formation/show.html.twig', [
            'formation' => $formations,]);
    }
}
