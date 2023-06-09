<?php

namespace App\Controller;

use App\Entity\Stagiaire;
use App\Form\StagiaireType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class StagiaireController extends AbstractController
{
    #[Route('/stagiaire/create', name: 'create_stagiaire')]
    public function create(EntityManagerInterface $entityManager, Stagiaire $stagiaire=null, Request $request): Response
    {
        //Creation du formulaire

        $form= $this->createForm(StagiaireType::class, $stagiaire);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $stagiaire= $form->getData();
            $entityManager->persist($stagiaire);
            $entityManager->flush();

            return $this->redirectToRoute('detail_stagiaire',array('id' => $stagiaire->getId()));
        }

        return $this->render('stagiaire/create.html.twig', [
           'formAddStagiaire' => $form->createView(),
        ]);
    }

    #[Route('/stagiaire/{idSession}/add', name:'add_stagiaire')]
    public function add(EntityManagerInterface $entityManager, Stagiaire $stagiaire=null, Request $request):Response
    {
        // $stagiaires=doctrine->getRepository(Stagiaire::class)->findAll
        //Creation du formulaire
        
        $form= $this->createForm(StagiaireType::class, $stagiaire);
        $form->handleRequest($request);
        
        if($form->isSubmitted() && $form->isValid()){
            
            $session= $form->getData();
            $entityManager->persist($stagiaire);
            $entityManager->flush();
            
            return $this->redirectToRoute('show_session',array('id' => $session->getFormation()->getId()));
        }
      
        return $this->render('stagiaire/add.html.twig', [
           'formAddSession' => $form->createView(),
        ]);

    }

    
     #[Route('/stagiaire/detail/{id}', name: 'detail_stagiaire')]
     public function detail(ManagerRegistry $doctrine, $id):Response{
        $stagiaire= $doctrine->getRepository(Stagiaire::class)->find($id);
        return $this->render('stagiaire/detail.html.twig', [
            'stagiaire' => $stagiaire,]);
     }
}
