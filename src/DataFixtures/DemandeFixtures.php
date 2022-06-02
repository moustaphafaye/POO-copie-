<?php

namespace App\DataFixtures;

use App\Entity\Demande;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class DemandeFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $motif=["je suis malade","Je dois voyager","J'ai un mariage"];
        $etat=["valide","annuller"];
        
        
        for ($i=0; $i< 6; $i++){
            $demande=new Demande();
            $a=rand(0,2);
            $b=rand(0,1);

            $demande->setMotif($motif[$a]); 
            $demande->setEtat($etat[$b]); 
            $demande->setDate(null); 

           $a++;
           $b++;
            $manager->persist($demande); 
        }
        $manager->flush();
    }
}
