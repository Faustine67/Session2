<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Formation;
use App\Form\SessionType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SessionController extends AbstractController
{
    #[Route('/session/{idFormation}/add', name:'add_session')]
    public function add(EntityManagerInterface $entityManager, Session $session=null, Request $request):Response
    {
        //Creation du formulaire

        $form= $this->createForm(SessionType::class, $session);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $session= $form->getData();
            $entityManager->persist($session);
            $entityManager->flush();

            return $this->redirectToRoute('show_session',array('id' => $session->getFormation()->getId()));
        }

        return $this->render('session/add.html.twig', [
           'formAddSession' => $form->createView(),
        ]);

    }

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
