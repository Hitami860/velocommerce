<?php

namespace App\Controller;

use App\Entity\Actualite;
use App\Entity\Categorie;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MainController extends AbstractController
{
    #[Route('/', name: 'app_main')]
    public function index(EntityManagerInterface $entity): Response
    {
        $actualite = $entity->getRepository(  Actualite::class)->findAll();
        $categorie = $entity->getRepository(  Categorie::class)->findAll();
        return $this->render('main/index.html.twig', [
            'controller_name' => 'MainController',
            'categorie' => $categorie,
            'actualite' => $actualite,
        ]);
    }

}
