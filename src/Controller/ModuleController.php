<?php

namespace App\Controller;

use App\Entity\Module;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ModuleController extends AbstractController
{
    #[Route('/module/{id}', name: 'app_module')]
    public function index(ManagerRegistry $doctrine, Module $module): Response
    {
        $modules= $doctrine->getRepository(Module::class)->findAll();
        return $this->render('module/index.html.twig', [
            'module' => $modules,
        ]);
    }
}
