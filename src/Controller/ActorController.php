<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Film ;
use App\Entity\Actor ;
use App\Repository\ActorRepository ;
use App\Form\ActorType ;

use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;

class ActorController extends AbstractController
{
    /**
     * @Route("/actor", name="actor")
     */
    public function index(ActorRepository $ar): Response
    {   
        $repository = $this->getDoctrine()->getRepository(Actor::class);
        $actors = $repository->findAll();
        return $this->render('actor/index.html.twig', [
            'actors' => $actors
            
        ]);
    }

/**
 * @Route("/afficheactor/{id}", name="afficheactor")
 */

 public function afficheUnActeur(ActorRepository  $ar,$id): Response 
 {
     
     $actor =  $ar->find($id);
     return $this->render('actor/afficheUn.html.twig',["actor"=>$actor,]);
 }

 /**
 * @Route("/modifactor/{id}", name="modifactor")
 * @Route("/creationactor", name="creationactor")
 */


 public function modifierActor(Actor $actor=null,Request $request, EntityManagerInterface $en ){
   
    if (!$actor ) {
        $actor = new Actor();
    
    }
   
   
    $form = $this->createForm(ActorType::class,$actor);

    $form->handleRequest($request);
    if ($form->isSubmitted() ) {
        $en->persist($actor) ;
        $en->flush();
        return $this->redirectToRoute('actor');
    }
    return $this->render('actor/modifactor.html.twig',[
        "actor"=>$actor,
        "form"=>$form->createView()]);
 }

}
