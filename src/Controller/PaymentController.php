<?php

namespace App\Controller;


use App\Services\PaymentServicesInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;


class PaymentController extends AbstractController
{
    #[Route('/payment', name: 'app_payment')]
    public function paymentStripe(PaymentServicesInterface $paymentServicesInterface): Response
    {
        return $this->redirect($paymentServicesInterface->PaymentStripe());
    }


    #[Route('/success_url', name: 'success_url')]
    public function success(): Response
    {
        return $this->redirectToRoute('app_commandes');

    }


    #[Route('/cancel_url', name: 'cancel_url')]
    public function cancel(): Response
    {
        return $this->render('payment/cancel.html.twig', []);
    }
}
