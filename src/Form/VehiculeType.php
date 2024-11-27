<?php

namespace App\Form;

use App\Entity\Proprietaire;
use App\Entity\Vehicule;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VehiculeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('marque', TextType::class, [
                'label' => 'Marque',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('modele', TextType::class, [
                'label' => 'Modèle',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('dateImmatriculation', DateType::class, [
                'label' => 'Date d\'immatriculation',
                'widget' => 'single_text',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('numeroImmatriculation', TextType::class, [
                'label' => 'Numéro d\'immatriculation',
                'attr' => ['class' => 'form-control'],
            ])
            ->add('proprietaire', EntityType::class, [
                'class' => Proprietaire::class,
                'choice_label' => function(Proprietaire $proprietaire) {
                    return $proprietaire->getNom() . ' ' . $proprietaire->getPrenom();
                },
                'attr' => ['class' => 'form-control'],
            ])
            ->add('caracteristiques', CollectionType::class, [
                'entry_type' => CaracteristiqueType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Vehicule::class,
        ]);
    }
}