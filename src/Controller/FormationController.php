<?php

namespace App\Controller;

use App\Entity\Session;
use App\Entity\Formation;
use App\Form\FormationType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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
            'formation' => $formation,]);
    }

    #[Route('/formation/add', name: 'add_formation')]
    public function add(EntityManagerInterface $entityManager, Formation $formation=null, Request $request): Response
    {
        //Creation du formulaire

        $form= $this->createForm(FormationType::class, $formation);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $formation= $form->getData();
            $entityManager->persist($formation);
            $entityManager->flush();

            return $this->redirectToRoute('detail_formation',array('id' => $formation->getId()));
        }

        return $this->render('formation/add.html.twig', [
           'formAddFormation' => $form->createView(),
        ]);
    }
}
