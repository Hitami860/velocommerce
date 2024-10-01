<?php

namespace App\Controller;

use App\Entity\Produits;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProduitsController extends AbstractController
{
    #[Route('/produits', name: 'app_produits')]
    public function index(): Response
    {
        return $this->render('produits/produits.html.twig', [
            'controller_name' => 'ProduitsController',
        ]);
    }

#[Route('/produits', name: 'app_produits')]
    public function produits(EntityManagerInterface $entity): Response
    {
        $produits = $entity->getRepository(Produits::class)->findAll();
        return $this->render('produits/produits.html.twig', [
            'controller_name' => 'ProduitsController',
            'produits' => $produits
        ]);
    }

}
