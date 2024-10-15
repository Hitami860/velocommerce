<?php

namespace App\Controller;

use App\Entity\Actualite;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ActualiteController extends AbstractController
{
    #[Route('/actualite', name: 'app_actualite')]
    public function index(): Response
    {
        return $this->render('actualite/index.html.twig', [
            'controller_name' => 'ActualiteController',
        ]);
    }

    #[Route('/actualite', name: 'app_actualite')]
    public function Actualite(EntityManagerInterface $entity): Response
    {
        $actualite = $entity->getRepository(Actualite::class)->findAll();
        return $this->render('actualite/index.html.twig', [
            'controller_name' => 'ActualiteController',
            'actualite' => $actualite,
        ]);
    }

    #[Route('/actualite/{id}', name: 'app_actualite')]
    public function actualiteid($id, EntityManagerInterface $entity): Response
    {
        $actualite = $entity->getRepository(Actualite::class)->findAll();
        $actualites = $entity->getRepository(Actualite::class)->findOneBy(['id' => $id]);
        return $this->render('actualite/actualite.html.twig', [
            'controller_name' => 'MainController',
            'id' => $id,
            'actualite' => $actualite,
            'actualites' => $actualites
        ]);
    }
}
