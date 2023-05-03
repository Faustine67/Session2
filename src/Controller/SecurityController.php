<?php

namespace App\Controller;

use App\Entity\Stagiaire;
use App\Entity\Formateur;
use App\Entity\Formation;
use App\Entity\Session;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    #[Route(path: 'security/home', name: 'home')]
    public function home(EntityManagerInterface $entityManager) {
        if ($this->getUser()) {

            $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

            $stagiaireRepo = $entityManager->getRepository(Stagiaire::class);
            $formateurRepo = $entityManager->getRepository(Formateur::class);
            $formationRepo = $entityManager->getRepository(Formation::class);
            $sessionRepo = $entityManager->getRepository(Session::class);
    
            $stagiaireCount = $stagiaireRepo->count([]);
            $formateurCount = $formateurRepo->count([]);
            $formationCount = $formationRepo->count([]);

            $incomingSessions = $sessionRepo->findIncomingSessions();
            $inProgressSessions =  $sessionRepo->findInProgressSessions();
            $passedSessions =  $sessionRepo->findPassedSessions();

            return $this->render('security/home.html.twig', [
                'stagiaireCount' => $stagiaireCount,
                'formateurCount' => $formateurCount,
                'formationCount' => $formationCount,
                'incSessions' => $incomingSessions,
                'inProgressSessions' => $inProgressSessions,
                'passedSessions' => $passedSessions
            ]);
        }
        else {
            return $this->render('/home.html.twig');
        }
    }

   
    #[Route(path: 'security/login', name: 'app_login')]
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        if ($this->getUser()) {
            return $this->redirectToRoute('app_home');
        }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    #[Route(path: 'security/logout', name: 'app_logout')]
    public function logout(): void
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }

    #[Route(path: 'security/show', name: 'show')]
    public function show(EntityManagerInterface $entityManager): Response
    {

        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $stagiaireRepo = $entityManager->getRepository(Stagiaire::class);
        $trainerRepo = $entityManager->getRepository(Trainer::class);
        $trainingRepo = $entityManager->getRepository(Training::class);
        $sessionRepo = $entityManager->getRepository(Session::class);

        $stagiaireCount = $stagiaireRepo->count([]);
        $trainerCount = $trainerRepo->count([]);
        $trainingCount = $trainingRepo->count([]);

        $incomingSessions = $sessionRepo->findIncomingSessions();
        $inProgressSessions =  $sessionRepo->findInProgressSessions();
        $passedSessions =  $sessionRepo->findPassedSessions();

        return $this->render('security/home.html.twig', [])
        //     'stagiaireCount' => $stagiaireCount,
        //     'trainerCount' => $trainerCount,
        //     'trainingCount' => $trainingCount,
        //     'incSessions' => $incomingSessions,
        //     'inProgressSessions' => $inProgressSessions,
        //     'passedSessions' => $passedSessions
        // ]);
    ;
    }
}
