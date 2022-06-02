<?php

namespace App\DataFixtures;

use App\Entity\Etudiant;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class EtudiantFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
       $nom=["Ilimane FAYE","Moussa FALL","Demba DIENG","Koni Js","Malick SOUI"];
       $matricule=["09ZE","23CV","56JK","AZ23","045RT"];
       
       $adres=["bour","thies","Dakar","kadfl","Falloi"];
       $login=["Ilimane@FAYE","Moussa@FALL","Demba@DIENG","Koni@Js","Malick@SOUI"];
       $password=["bour1","1thies","Dak3ar","kad2fl","Fal1loi"];

       $sexe=["M","F"];
       $n=0;$m=0;$a=0;
       for($i=0;$i<5;$i++){
        $s=rand(0,1);
        $etudiant= new Etudiant(); 
        $etudiant->setNomComplet($nom[$n]); 
        $etudiant->setLogin($login[$n].$s); 
        $etudiant->setPassword($password[$a]); 

        $etudiant->setMatricule($matricule[$m]); 
        $etudiant->setAdresse($adres[$a]); 
        $etudiant->setSexe($sexe[$s]);

        // for($j=0; $j < 2; $j++){
        //     $ref=rand(0,3);
        //     $etudiant->addInscription($this->getReference('inscription'.$ref)); 
        // }
        $n++;$m++;$a++;
        $manager->persist($etudiant);
       }

        $manager->flush();
    }
}
