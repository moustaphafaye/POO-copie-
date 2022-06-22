<?php

namespace App\Form;

use App\Entity\Classe;
use App\Entity\Module;
use App\Entity\Professeur;
use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class ProfesseurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomComplet')
            ->add('sexe',ChoiceType::class,[
                'choices'=>[
                    'M'=>'M',
                    'F'=>'f']])
            ->add('grade',ChoiceType::class,[
                'choices'=>[
                    'ingenier'=>'ingenier',
                    'Docteur'=>'Docteur',
                    'Master'=>'Master'
                ]])
            ->add('classes',EntityType::class,[
                'class'=>Classe::class,
                'multiple'=>true, 
                'expanded'=>true ])
            ->add('modules',EntityType::class,[
                'class'=>Module::class,
                'multiple'=>true,
                'expanded'=>true
             ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Professeur::class,
        ]);
    }
}
