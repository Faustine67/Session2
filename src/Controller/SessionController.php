<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Formation;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_session')]
    public function index(): Response
    {
        return $this->render('session/index.html.twig', [
            'controller_name' => 'SessionController',
        ]);
    }

    #[Route('/session/{id}', name: 'show_session')]
    public function show (ManagerRegistry $doctrine, Formation $formation, Session $session): Response
    {
        return $this->render('session/show.html.twig', [
            'session' => $session,]);
    }
}
