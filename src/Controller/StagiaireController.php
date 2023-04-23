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
    #[Route('/stagiaire/add', name: 'add_stagiaire')]
    public function add(ManagerRegistry $doctrine, Stagiaire $stagiaire, Request $request): Response
    {
        $stagiaires = $doctrine->getRepository(Stagiaire::class)->findAll();

        //Si le stagiaire n'existe pas dans la liste alors on en créer un
        if(!stagiaire){
        $stagiaire = new Stagiaire();
        }

        //Creation du formulaire

        $form= $this->createForm(StagiaireType::class, $stagiaire);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $stagiaire= $form->getData();
            $entityManager->persist($stagiaire);
            $entityManager->flush();

            return $this->redirectToRoute('add_stagiaire');
        }

        return $this->render('stagiaire/add.html.twig', [
            'controller_name' => 'StagiaireController',
            'stagiaire' => $stagiaires,
           'formAddStagiaire' => $form->createView(),
        ]);
    }

     #[Route('/stagiaire/detail/{id}', name: 'detail_stagiaire')]
     public function detail(ManagerRegistry $doctrine, $id):Response{
        $stagiaire= $doctrine->getRepository(Stagiaire::class)->find($id);
        return $this->render('stagiaire/detail.html.twig', [
            'stagiaire' => $stagiaire,]);
     }
}
