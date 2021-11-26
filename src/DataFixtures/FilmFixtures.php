<?php

namespace App\DataFixtures;
use App\Entity\Actor ;
use App\Entity\Film;
use App\Entity\Director;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class FilmFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
         $a1 = new Film();
         $a1-> setTitre('Ready Player One')->setDescription("En 2045, la planète frôle le chaos et s'effondre, mais les gens trouvent du réconfort dans l'OASIS, un monde virtuel créé par James Halliday. Lorsque Halliday meurt, il promet son immense fortune à la première personne qui découvre un oeuf de Pâques numérique caché dans l'OASIS.")
         ->setAffiche("RPO.jpg") ;
        
      
         $manager->persist($a1);

         $a2 = new Film();
         $a2-> setTitre('Forrest Gump')->setDescription("Quelques décennies d'histoire américaine, des années 1940 à la fin du XXème siècle, à travers le regard et l'étrange odyssée d'un homme simple et pur, Forrest Gump.")
         ->setAffiche("forest.jpg") ;
          $manager->persist($a2);
         
      
      
         $a3 = new Film();
         $a3-> setTitre('Le Roi Lion')->setDescription("Le long combat de Simba le lionceau pour accéder à son rang de roi des animaux, après que le fourbe Scar, son oncle, a tué son père et pris sa place.")
         ->setAffiche("Roilion.jpg") ;
         
         $manager->persist($a3);


         $actor1 = new Actor();
         $actor1->setNom("jean-paul")
                     ->setPrenom("Belmondo")
                     ->setImage("jp.jpg")
                     ->addFilm($a1)
                     ->addFilm($a2)
                     ;
             $manager->persist($actor1);

             $actor2 = new Actor();
         $actor2->setNom("Le Corre")
                     ->setPrenom("Mathis")
                     ->setImage("kad.jpg")
                     ->addFilm($a1)
                
                     ;
             $manager->persist($actor2);

             $actor3 = new Actor();
             $actor3->setNom("Spacey")
                         ->setPrenom("Kevin")
                         ->setImage("spacey.jpg")
                         ->addFilm($a2)
                         ->addFilm($a3)
                    
                         ;
                 $manager->persist($actor3);

                 
             $actor4 = new Actor();
             $actor4->setNom("Freeman")
                         ->setPrenom("Morgan")
                         ->setImage("freeman.jpg")
                         ->addFilm($a2)
                         
                    
                         ;
                 $manager->persist($actor4);

                 $dir1 = new Director();
                 $dir1->setNom("Spielberg")
                             ->setPrenom("Steven")
                             ->addFilm($a2)
                             
                        
                             ;
                     $manager->persist($dir1);

                     $dir2 = new Director();
                     $dir2->setNom("Lucas")
                                 ->setPrenom("George")
                                 ->addFilm($a3)
                                 
                            
                                 ;
                         $manager->persist($dir2);

                         
                     $dir3 = new Director();
                     $dir3->setNom("Tarantino")
                                 ->setPrenom("Quentin")
                                 ->addFilm($a1)
                                 
                            
                                 ;
                         $manager->persist($dir3);
        
    
    

        $manager->flush();
    }
}