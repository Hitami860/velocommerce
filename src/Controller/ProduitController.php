<?php

namespace App\Controller;

use App\Entity\Produits;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProduitController extends AbstractController
{
    #[Route('/produit', name: 'app_produit')]
    public function index(): Response
    {
        return $this->render('produit/index.html.twig', [
            'controller_name' => 'ProduitController',
        ]);
    }


#[Route('/produit/{id}', name: 'app_produit')]
    public function produit($id, EntityManagerInterface $entity): Response
    {
        $produit = $entity->getRepository(Produits::class)->findOneBy(['id' => $id]);
        return $this->render('produit/produit.html.twig', [
            'controller_name' => 'ProduitController',
            'id' => $id,
            'produit' => $produit,
        ]);
    }
}


