<?php

namespace App\Controller;

use App\Entity\Artwork;
use App\Form\ArtworkType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\Routing\Annotation\Route;

#[IsGranted('ROLE_USER')]
class UserArtworkController extends AbstractController
{
    #[Route('/my/artworks', name: 'my_artworks_index')]
    public function index(): Response
    {    
        $repository = $this->getDoctrine()->getRepository(Artwork::class);
        $artworks = $repository->findBy(['user'=>$this->getUser()],['date_create'=>'DESC']);
        return $this->render('user_artwork/index.html.twig', [
            'artworks' => $artworks,
        ]);
    }

    #[Route('/my/artworks/new', name: 'my_artworks_create')]
    public function create(Request $request, EntityManagerInterface $manager): Response
    {    
       $artwork= new Artwork();
       $form=$this->createForm(ArtworkType::class,$artwork);
       $form->handleRequest($request);
       if($form->isSubmitted() && $form->isValid()){
           $artwork=$form->getData();
           $manager->persist($artwork);
           $manager->flush();
           return $this->redirectToRoute('my_artworks_index');
       }
        return $this->render('user_artwork/create.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/my/artworks/edit/{id}', name: 'my_artworks_edit')]
    public function edit(Artwork $artwork, Request $request, EntityManagerInterface $manager): Response
    {    
       $form=$this->createForm(ArtworkType::class,$artwork);
       $form->handleRequest($request);
       if($form->isSubmitted() && $form->isValid()){
           $artwork=$form->getData();
           $manager->persist($artwork);
           $manager->flush();
           return $this->redirectToRoute('my_artworks_index');
       }
        return $this->render('user_artwork/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    #[Route('/my/artworks/delete/{id}', name: 'my_artworks_delete')]
    public function delete(Artwork $artwork, EntityManagerInterface $manager): Response
    {    
        $manager->remove($artwork);
        $manager->flush();
        return $this->redirectToRoute('my_artworks_index');
       
    }
}
