<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Entity\Chanson;
use App\Entity\Genre;
use App\Form\ChansonType;


class ChansonsController extends AbstractController
{
    /*route de la page d'acceuil qui liste toutes les chansons il manque la date de sortie il faut utiliser format mais je ne sais plus comment faire*/
    #[Route('/', name: 'Home')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        /*recuperation de toutes les chansons dans la db */
        $repository = $entityManager->getRepository(Chanson::class);
        $chansons = $repository->findAll();

        return $this->render('chansons/index.html.twig', [
            'controller_name' => 'Bienvenue sur notre catalogue de chansons ',
            'chansons' =>$chansons
        ]);
    }

    /*detail de la chanson avec recupération de l'id*/

    #[Route('/detail/{id}', name: 'detail')]
    public function detailChanson($id, Request $request, EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Chanson::class);
        $chanson = $repository->find($id);
        
        return $this->render('chansons/detailChanson.html.twig', [
            'controller_name' => 'Detail de la chanson ',
            'chanson' =>$chanson
        ]);
    }

    /* ajout d'une chanson via le formulaire */

    #[Route('/addChanson', name: 'addChanson')]
    public function addChanson(Request $request, EntityManagerInterface $entityManager): Response
    {
        $chanson = new Chanson;
        $form = $this ->createForm(ChansonType::class, $chanson);
        $form -> handleRequest($request);

        if($form ->isSubmitted() && $form -> isValid()){
           $chanson = $form -> getData();

           $entityManager->persist($chanson);
           $entityManager->flush();


           return $this -> redirectToRoute('Home');
        }


        return $this->render('chansons/addChanson.html.twig', [
            'controller_name' => 'ajouter une chanson ',
            'form' => $form, 
            'chanson' => $chanson
        ]);
    }

    #[Route('/modifChanson/{id}', name: 'modifChanson')]
    public function modifChanson($id,Request $request, EntityManagerInterface $entityManager): Response
    {
        $repository = $entityManager->getRepository(Chanson::class);
        $chanson = $repository->find($id);

        $form = $this ->createForm(ChansonType::class, $chanson);
        $form -> handleRequest($request);

        if($form ->isSubmitted() && $form -> isValid()){
           $chanson = $form -> getData();

          
           $entityManager->flush();


           return $this -> redirectToRoute('Home');
        }


        return $this->render('chansons/modifChanson.html.twig', [
            'controller_name' => 'Modifier la chanson ',
            'form' => $form, 
            'chanson' => $chanson
        ]);
    }
}
