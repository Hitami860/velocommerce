<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class FavorisController extends AbstractController
{
    #[Route('/favoris', name: 'app_favoris')]
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        return $this->render('favoris/favoris.html.twig', [
            'controller_name' => 'FavorisController',
        ]);
    }
}
