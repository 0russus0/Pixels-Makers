<?php

namespace App\Controller;

use App\Entity\Artwork;
use App\Repository\ArtworkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'home')]
    public function index(): Response
    {
        $repository=$this->getDoctrine()->getRepository(Artwork::class);
        $artworks=$repository->findLatest();
        return $this->render('home/index.html.twig', [
            'artworks' => $artworks,
        ]);
    }
}
