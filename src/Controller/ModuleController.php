<?php

namespace App\Controller;

use App\Entity\Module;
use App\Form\ModuleType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ModuleController extends AbstractController
{
    
    // ATTENTION, il faut toujours mettre la fonction add avant formation/id sinon le controller ne trouvera pas l'entity
        #[Route('/module/create', name: 'create_module')]
         public function create(EntityManagerInterface $entityManager, Module $module=null, Request $request): Response
        {
             //Creation du formulaire
     
             $form= $this->createForm(ModuleType::class, $module);
             $form->handleRequest($request);
     
             if($form->isSubmitted() && $form->isValid()){
     
                 $module= $form->getData();
                 $entityManager->persist($module);
                 $entityManager->flush();
     
                 return $this->redirectToRoute('app_session',array('id' => $module->getId()));
             }
     
             return $this->render('module/create.html.twig', [
                'formAddModule' => $form->createView(),
             ]);
            }

    #[Route('/module/{id}', name: 'app_module')]
    public function index(ManagerRegistry $doctrine, Module $module): Response
    {
        $modules= $doctrine->getRepository(Module::class)->findAll();
        return $this->render('module/index.html.twig', [
            'module' => $modules,
        ]);
    }
     }

