<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Produits;
use App\Repository\ProduitsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class CategorieController extends AbstractController
{
    #[Route('/categorie', name: 'app_categorie')]
    public function index(): Response
    {
        return $this->render('categorie/index.html.twig', [
            'controller_name' => 'CategorieController',
        ]);
    }


    #[Route('/categorie/{id}', name: 'app_categorie')]
    public function categorie($id, EntityManagerInterface $entity, EntityManagerInterface $produit): Response
    {
        $categorie = $entity->getRepository(Categorie::class)->findOneBy(['id' => $id]);
        $produit = $produit->getRepository(Produits::class)->findBy(['categorie' => $categorie]);
        return $this->render('categorie/categorie.html.twig', [
            'controller_name' => 'CategorieController',
            'produit' => $produit,
            'id' => $id,
            'categorie' => $categorie,
        ]);
    }
}
