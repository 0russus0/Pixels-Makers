<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MakersListController extends AbstractController
{
    #[Route('/makers/list', name: 'makers_list')]
    public function index(): Response
    {
        return $this->render('makers_list/index.html.twig', [
            'controller_name' => 'MakersListController',
        ]);
    }
}
