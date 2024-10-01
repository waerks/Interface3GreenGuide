<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Element;
use App\Entity\Recette;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class RecetteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('image', FileType::class, [
                'label' => 'Image (PNG, JPEG)',
                'required' => false,
                'mapped' => false, // To avoid saving directly in the entity
                'constraints' => [
                    new File([
                        'maxSize' => '5M',
                        'mimeTypes' => [
                            'image/png',
                            'image/jpeg',
                            'image/jpg',
                        ],
                        'mimeTypesMessage' => 'Veuillez uploader une image valide (PNG, JPEG)',
                    ])
                ],
            ])
            
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
            ->add('etapes', CollectionType::class, [
                'entry_type' => TextType::class, // Or another field type
                'allow_add' => true,
                'allow_delete' => true,
                'prototype' => true,  // Important for dynamic fields
                'by_reference' => false,
                'entry_options' => ['label' => 'Étape'],
            ])
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'pseudo',
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
