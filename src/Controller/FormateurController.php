<?php

namespace App\Controller;

use App\Entity\Formateur;
use App\Form\FormateurType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormateurController extends AbstractController
{

    #[Route('/formateur/create', name: 'create_formateur')]
    public function create(EntityManagerInterface $entityManager, Formateur $formateur=null, Request $request): Response
    {
        //Creation du formulaire

        $form= $this->createForm(FormateurType::class, $formateur);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $formateur= $form->getData();
            $entityManager->persist($formateur);
            $entityManager->flush();

            return $this->redirectToRoute('detail_formateur',array('id' => $formateur->getId()));
        }

        return $this->render('formateur/create.html.twig', [
           'formAddFormateur' => $form->createView(),
        ]);
    }

    #[Route('/formateur/detail/{id}', name: 'detail_formateur')]
    public function detail(ManagerRegistry $doctrine, $id):Response{
       $formateur= $doctrine->getRepository(Formateur::class)->find($id);
       return $this->render('formateur/detail.html.twig', [
           'formateur' => $formateur,]);
    }

    #[Route('/formateur', name: 'app_formateur')]
    public function index(): Response
    {
        return $this->render('formateur/index.html.twig', [
            'controller_name' => 'FormateurController',
        ]);
    }
}
