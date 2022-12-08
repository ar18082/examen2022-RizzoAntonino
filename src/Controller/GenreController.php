<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Chanson;
use App\Entity\Genre;
use App\Form\GenreType;

class GenreController extends AbstractController
{   
    #[Route('/genre', name: 'genre')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {   

         $repository = $entityManager->getRepository(Genre::class);
         $genres = $repository->findAll();

        
        
        return $this->render('genre/index.html.twig', [
            'controller_name' => 'Liste des genres',
            'genres' =>$genres
            
        ]);
    }

    #[Route('/addGenre', name: 'addGenre')]
    public function addGenre(Request $request, EntityManagerInterface $entityManager): Response
    {
        $genre = new Genre;
        $form= $this ->createForm(GenreType::class, $genre);
        $form-> handleRequest($request);

        if($form ->isSubmitted() && $form -> isValid()){
           $genre = $form -> getData();

           $entityManager->persist($genre);
           $entityManager->flush();


           return $this -> redirectToRoute('Home');
        }
        return $this->render('genre/addGenre.html.twig', [
            'controller_name' => 'ajouter un genre',
            'genre' => $genre, 
            'form' =>$form
        ]);
    }

    #[Route('/modifGenre/{id}', name: 'modifGenre')]
    public function modifGenre($id,Request $request, EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Genre::class);
        $genre = $repository->find($id);

        $form = $this ->createForm(GenreType::class, $genre);
        $form -> handleRequest($request);

        if($form ->isSubmitted() && $form -> isValid()){
           $genre = $form -> getData();

          
           $entityManager->flush();


           return $this -> redirectToRoute('Home');
        }


        return $this->render('genre/modifGenre.html.twig', [
            'controller_name' => 'Modifier le genre ',
            'form' => $form, 
            'genre' => $genre
        ]);
    }
}
