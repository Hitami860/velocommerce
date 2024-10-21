<?php

namespace App\Services;

use App\Entity\Produits;
use App\Repository\ProduitsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class PaymentServices implements PaymentServicesInterface{
    public function __construct( private readonly RequestStack $requestStack, 
    private readonly EntityManagerInterface $entity,
    private readonly UrlGeneratorInterface $urlGeneratorInterface,
    private readonly ProduitsRepository $produit){}

    public function PaymentStripe(){
        $session = $this->requestStack->getSession();
        $panier = $session->get('panier',[]);
        $stripe = new \Stripe\StripeClient('sk_test_51QCFuAERgOBFm96yJCK3D9giKek21za414GLPUrxVTgeyQfOn8vvHvUk25UqFFysBSzpoV8JNwIdC44tRqYnrhGr00em8xr5qO');
        $checkout_session = $stripe->checkout->sessions->create([
            'success_url' => $this->urlGeneratorInterface->generate("success_url", [], UrlGeneratorInterface::ABSOLUTE_URL),
            
            'cancel_url' => $this->urlGeneratorInterface->generate("cancel_url",[],UrlGeneratorInterface::ABSOLUTE_URL),
            'line_items' => [
                $this->Loop($panier),
            ],
            'mode' => 'payment',
           
        ]);
       
        return $checkout_session->url;
    }

    private function Loop($panier){
        foreach($panier as $id => $qty){
            $product = $this->produit->findOneBy(['id' => $id]);
            $data["price_data"]["unit_amount"] = $product->getPrix() * 100;
            $data["price_data"]["product_data"]["name"] = $product->getNom();
            $data["price_data"]["currency"] = 'eur';
            $data["quantity"] = $qty;
            $datas[] = $data;
        }
        return $datas;
    }
}
