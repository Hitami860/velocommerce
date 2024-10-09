<?php

namespace App\Controller;

use App\Entity\Produits;
use App\Repository\ProduitsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Attribute\Route;

class PanierController extends AbstractController
{

    #[Route('/panier', name: 'app_panier')]
    public function panierCreate(SessionInterface $session, EntityManagerInterface $entity,): Response
    { 
        $panier = $session->get('panier', []);

        $data = [];
        $total = 0;

        foreach($panier as $id => $quantite){
            $produit = $entity->getRepository( Produits::class)->find($id);

            $data[] = [
                'produit' => $produit,
                'quantite' => $quantite,
            ];
            $total += $produit->getPrix() * $quantite;
        }
        return $this->render('panier/panier.html.twig',[
            'controller_name' => 'PanierController',
            'data'=>$data,
            'total'=>$total,
        ]);
        
    }



    #[Route('/add/{id}', name: 'add_panier')]
    public function addPanier(Produits $produit,RequestStack $requestStack,): Response
    {
        $session = $requestStack->getSession();
        $id = $produit->getId();
        $panier = $session->get('panier',[]);

        if(empty($panier[$id])){
            $panier[$id] = 1;
        }else{
            $panier[$id]++;
        }
        

        $session->set('panier', $panier);

        return $this->redirectToRoute('app_panier',[
            'controller_name' => 'PanierController',
            'panier'=>$panier,
        ]);
    }

    #[Route('/remove/{id}', name: 'app_remove')]

    public function remove(Produits $produit, RequestStack $requestStack): Response
    {
    
        $session = $requestStack->getSession();
        $id = $produit->getId();
        $panier = $session->get('panier',[]);

        if(!empty($panier[$id])){
            if($panier[$id] > 1){
                $panier[$id]--;
            }else{
                unset($panier[$id]);
            }
        }

        $session->set("panier", $panier);

        return $this->redirectToRoute('app_panier',[
            'controller_name' => 'PanierController',
            'panier'=>$panier,
        ]);
    }

    #[Route('/delete/{id}', name: 'app_delete')]
    public function delete(Produits $produit, RequestStack $requestStack): Response
    {
        $session = $requestStack->getSession();
        $id = $produit->getId();
        $panier = $session->get('panier',[]);

        if(!empty($panier[$id])){
            unset($panier[$id]);
        }

        $session->set("panier", $panier);

        return $this->redirectToRoute('app_panier', [
            'controller_name' => 'PanierController',
            'panier'=>$panier,
        ]);
    }

    #[Route('/supprimer', name: 'panier_supp')]
    public function panierSupp(RequestStack $requestStack)
    {
        $session = $requestStack->getSession();
        $session->remove("panier");

        return $this->redirectToRoute("app_panier");
    }

}
