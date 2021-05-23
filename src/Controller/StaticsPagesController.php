<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StaticsPagesController extends AbstractController
{
    #[Route('/statics/pages', name: 'statics_pages')]
    public function index(): Response
    {
        return $this->render('statics_pages/index.html.twig', [
            'controller_name' => 'StaticsPagesController',
        ]);
    }
}
