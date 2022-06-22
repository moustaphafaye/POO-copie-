<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\Professeur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ClasseType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('libele')    
            ->add('filiere',ChoiceType::class,[
                'choices'=>[
                    'Dev Web'=>'Dev Web',
                    'Ref Dig'=>'Ref Dig',
                    'Dev Data'=>'Dev Data'
                ]
                // TextType::class,[
                //     'label'=>'Libelle',
                //     'required'=>false,
                //     'attr'=>['class'=>'form-control']
                // ]
            ])
            ->add('niveau',ChoiceType::class,[
                'choices'=>Classe::$niveaux
            ])  
         ->add('professeurs',EntityType::class,[
          'class'=>Professeur::class,
          'multiple'=>true,
          'expanded'=>false
      ])
    ;   
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Classe::class,
        ]);
    }
}
