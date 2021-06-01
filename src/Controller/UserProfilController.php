<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserProfilController extends AbstractController
{
    #[Route('/user/profil', name: 'user_profil')]
    public function index(): Response
    {
        return $this->render('user_profil/index.html.twig', [
            'controller_name' => 'UserProfilController',
        ]);
    }
}
