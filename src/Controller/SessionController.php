<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Formation;
use App\Entity\Stagiaire;
use App\Form\SessionType;
use App\Repository\SessionRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

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
    public function show (ManagerRegistry $doctrine, Formation $formation, Session $session=null, SessionRepository $sr): Response
    {
        $session_id=$session->getId();
        $noninscrits= $sr->findNonInscrits($session_id);

        return $this->render('session/show.html.twig', [
            'session' => $session,
            'nonInscrits' => $noninscrits]);
    }

    #[Route("/session/removeStagiaire/{idSe}/{idSt}", name: 'removeStagiaire')]
    // ParamConverter permet de convertir les parametres en instances de Session et de Stagiaire en utilisant l'injection de
    // dependance de Doctrine pour recuper les entités correspondant à la base de donnée
    #[ParamConverter("session", options:["mapping"=>["idSe"=>"id"]])]
    #[ParamConverter("stagiaire", options:["mapping"=>["idSt"=>"id"]])]

    public function removeStagiaire(ManagerRegistry $doctrine, Session $session, Stagiaire $stagiaire){
        $em = $doctrine->getManager();
        $session->removeStagiaire($stagiaire);
        $em->persist($session);
        $em->flush();

    return $this->redirectToRoute('show_session', ['id' => $session->getId()]);
}   

    
    #[Route("/session/addStagiaire/{idSe}/{idSt}", name: 'addStagiaire')]
    #[ParamConverter("session", options:["mapping"=>["idSe"=>"id"]])]
    #[ParamConverter("stagiaire", options:["mapping"=>["idSt"=>"id"]])]
    
    public function addStagiaire(ManagerRegistry $doctrine, Session $session, Stagiaire $stagiaire) {

        $em = $doctrine->getManager();
        $session->addStagiaire($stagiaire);
        $em->persist($session);
        $em->flush();

        return $this->redirectToRoute('show_session', ['id' => $session->getId()]);
    }   

}
