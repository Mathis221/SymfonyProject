<?php

namespace App\Form;
use App\Entity\Director ;
use App\Entity\Actor;
use App\Entity\Film;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilmType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titre')
            ->add('description')
            ->add('affiche')
            ->add('actors' , EntityType::class , [
                'mapped' => true ,
                'multiple' => true,
                'class' => Actor::class,
                'choice_label' => 'nom',
                'label' => 'actor'

            ])

                ->add('director' , EntityType::class , [
                    'mapped' => true ,
                    'class' => Director::class,
                    'choice_label' => 'nom',
                    'label' => 'directeur'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Film::class,
        ]);
    }
}