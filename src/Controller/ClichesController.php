<?php

namespace App\Controller;

use App\Entity\ClichesBike;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ClichesController extends AbstractController
{

    #[Route('/cliches', name: 'app_cliches')]
    public function ajouterCliches(EntityManagerInterface $entity): Response
    {
        $cliches = $entity->getRepository(ClichesBike::class)->findAll();
        return $this->render('cliches/cliches.html.twig', [
            'controller_name' => 'ClichesController',
            'cliches_bike' => $cliches
        ]);
    }

    #[Route('/cliches/{id}', name: 'app_cliches')]
    public function Cliches($id, EntityManagerInterface $entity): Response
    {
        $cliche = $entity->getRepository(   ClichesBike::class)->findOneBy(['id' => $id]);
        return $this->render('cliches/cliches.html.twig', [
            'controller_name' => 'ClichesController',
            'cliche' => $cliche
        ]);
    }
}
