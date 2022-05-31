<?php 
namespace App\DataFixtures ; 
use App\Entity\Classe ; 
use Doctrine\Persistence\ObjectManager ; 
use Doctrine\Bundle\FixturesBundle\Fixture ; 
class ClasseFixtures extends Fixture 
{ 
    public function load(ObjectManager $manager): void 
    { 
        // $product = new Product(); 
        // $manager->persist($product); 
        $filiere=['Dev Web','Dev Mobile','Dev Web Mobile'] ; 
        $niveaux=['L1','L2','L3'] ; 
        for ($i=0; $i <10 ; $i++) { 
            # code... 
            $classe= new Classe(); 
            $rand=rand(0,2); 
            $classe->setFiliere($filiere[$rand])
                   ->setNiveau($niveaux[$rand]) 
                   ->setLibele($niveaux[$rand].' '.$filiere[$rand]); 
            $manager->persist($classe); 
            $this->addReference('classe'.$i,$classe); 
            
        } 
        $manager->flush(); 
    } 
}