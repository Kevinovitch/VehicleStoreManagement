<?php

namespace App\Form;

use App\Entity\Caracteristique;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CaracteristiqueType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', ChoiceType::class, [
                'label' => 'Type de caractéristique',
                'required' => true,
                'choices' => [
                    'Nombre de portes' => 'Nombre de portes',
                    'Énergie' => 'Énergie',
                    'Boîte de vitesse' => 'Boîte de vitesse',
                    'Couleur' => 'Couleur',
                    'Puissance' => 'Puissance',
                    'Nombre de places' => 'Nombre de places',
                    'Kilométrage' => 'Kilométrage',
                    'Année' => 'Année'
                ],
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Choisir une caractéristique'
                ]
            ])
            ->add('valeur', TextType::class, [
                'label' => 'Valeur',
                'required' => true,
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Entrer la valeur'
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Caracteristique::class,
            'csrf_protection' => true,
            'csrf_field_name' => '_token',
            'csrf_token_id' => 'caracteristique_item'
        ]);
    }

    public function getBlockPrefix(): string
    {
        return 'caracteristique';
    }
}