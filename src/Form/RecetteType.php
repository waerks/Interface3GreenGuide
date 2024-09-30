<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Element;
use App\Entity\Recette;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class RecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('image', FileType::class)
            ->add('conseil')
            ->add('nombreDePersonnes')
            ->add('ingredients', CollectionType::class, [
                'entry_type' => TextType::class,
                'entry_options' => [
                    'label' => 'Ingredient',
                ],
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,  // This allows JavaScript to create new fields
                'by_reference' => false, // Needed for allowing add/remove operations
            ])
            ->add('tempsDePreparation')
            ->add('tempsDeCuisson')
            // ->add('etapes')
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
            ])
            // ->add('element', EntityType::class, [
            //     'class' => Element::class,
            //     'choice_label' => 'id',
            //     'multiple' => true,
            // ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Recette::class,
        ]);
    }
}
