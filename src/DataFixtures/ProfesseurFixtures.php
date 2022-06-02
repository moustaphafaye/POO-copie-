<?php 
namespace App\DataFixtures ; 
use App\Entity\Professeur ; 
use Doctrine\Persistence\ObjectManager ; 
use Doctrine\Bundle\FixturesBundle\Fixture ; 
class ProfesseurFixtures extends Fixture 
{ 
    public function load(ObjectManager $manager): void 
    { 
        // $product = new Product(); 
        // $manager->persist($product); 
        $sexes=["M","F"];
        $grade=['Docteur','Ingenieur'];
        $proff=['Moustapha FAYE','ALi Diop','Ablaye FAYE',"Mballo","Koni","Awa","Ilimane","Souleymane","Moussa","Mareme"];

        for ($i=0; $i < 10; $i++) { 
            # code...
             
            $sex=rand(0,1);
            $m=rand(0,9);
            $g=rand(0,1);
            $prof= new Professeur(); 
            $prof->setNomComplet($proff[$m]); 
            $prof->setGrade($grade[$g]); 
            $prof->setSexe($sexes[$sex]); 
           

            for ($j=0; $j < 2; $j++) { 
                # code... 
                $ref=rand(0,9);
                $prof->addClass($this->getReference('classe'.$ref)); 
            } 
            $manager->persist($prof); 

        }         
        $manager->flush();   
     }
}