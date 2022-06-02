<?php

namespace App\DataFixtures;

use App\Entity\Module;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class ModuleFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        $module=["Java","PHP","Algo","Html","Javascript","Python","SQL","POO"];
       $m=0;
        for ($i=0; $i < 6; $i++){
            // $m=rand(0,4);
            $modules=new Module();
            $modules->setlibelleModule($module[$m]); 
            $manager->persist($modules); 
           
        $m++;
        }
        $manager->flush();
    }
}
