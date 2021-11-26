<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

use App\Entity\Film ;
use App\Repository\FilmRepository;
use App\Form\FilmType ;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class FilmController extends AbstractController
{
    /**
     * @Route("/film", name="film")
     */
    public function index(FilmRepository $repository): Response
    {

        $films= $repository->findAll();
        return $this->render('film/index.html.twig', [
            'films' => $films
         
        ]);
    }



    /**
 * @Route("/affichefilm/{id}", name="affichefilm")
 */

 public function afficheUnFilm(FilmRepository $ar,$id): Response 
 {
     //
     $film =  $ar->find($id);
     return $this->render('film/afficheFilm.html.twig',["film"=>$film]);
 }


     /** 
    * @Route("/modiffilm/{id}", name="modiffilm")
    * @Route("/creationfilm", name="creationfilm")
    */
   
   
    public function modifierFilm(Film $film=null,Request $request, EntityManagerInterface $en ){
      
       if (!$film ) {
           $film = new Film();
       
       }
      
      
       $form = $this->createForm(FilmType::class,$film);
   
       $form->handleRequest($request);
       if ($form->isSubmitted() && $form->isValid() ) {
           $en->persist($film) ;
           $en->flush();
           return $this->redirectToRoute('film');
       }
       return $this->render('film/addFilm.html.twig',[
           "film"=>$film,
           "form"=>$form->createView()]);
    }
   
   }







