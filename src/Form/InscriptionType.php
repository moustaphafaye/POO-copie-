<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\Etudiant;
use App\Form\EtudiantType;
use App\Entity\Inscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class InscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('etudiant',EtudiantType::class,[
                'data_class'=>Etudiant::class
            ])
            ->add('classe',EntityType::class,[
                'class'=>Classe::class,
                'multiple'=>false,
                'choice_label'=>"libele"
            ])
            ->add('save',SubmitType::class)
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Inscription::class,
        ]);
    }
}
