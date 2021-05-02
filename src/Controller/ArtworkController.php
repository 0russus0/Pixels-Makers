<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ArtworkController extends AbstractController
{
    #[Route('/artwork', name: 'artwork')]
    public function index(): Response
    {
        return $this->render('artwork/index.html.twig', [
            'controller_name' => 'ArtworkController',
        ]);
    }
}
