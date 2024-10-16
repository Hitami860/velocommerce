<?php

namespace App\Controller;

use App\Entity\Commandes;
use App\Entity\CommandesDetails;
use App\Entity\Produits;
use App\Repository\ProduitsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

class CommandesController extends AbstractController
{
    #[Route('/commandes', name: 'app_commandes')]
    public function commandes(SessionInterface $session, EntityManagerInterface $em, ProduitsRepository $produitsRepository): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        $panier = $session->get('panier',[]);

        if($panier === []){
            $this->addFlash('vide', 'Votre panier est actuellment vide');
        };



        $commande = new Commandes();

        $commande->setReference(uniqid());
        $commande->setIdentifiant($this->getUser());
        $em->persist($commande);
        foreach($panier as $item => $quantite){
            $commandeDetails = new CommandesDetails();
            $produit = $produitsRepository->find($item);
            
            $prix = $produit->getPrix();

        $commandeDetails->addProduit($produit);
        $commandeDetails->setPrix($prix);
        $commandeDetails->setCommandes($commande);

        $em->persist($commandeDetails);
        }
        $em->flush();
        return $this->render('commandes/commandes.html.twig', [
            'controller_name' => 'CommandesController',
        ]);
    }
}
