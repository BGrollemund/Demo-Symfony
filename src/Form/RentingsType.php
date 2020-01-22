<?php

namespace App\Form;

use App\Entity\RenterTypes;
use App\Entity\Rentings;
use App\Entity\RentingTypes;
use App\Entity\Users;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RentingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('label', null, [
                'label' => 'Nom'
            ])
            ->add('location', null, [
                'label' => 'Emplacement'
            ])
            ->add('renting_type', EntityType::class, [
                'class' => RentingTypes::class,
                'required' => true,
                'label' => 'Type de location',
                'choice_label' => 'label',
                'multiple' => false
            ])
            ->add( 'renter_type', EntityType::class, [
                'class' => RenterTypes::class,
                'required' => true,
                'label' => 'A qui appartient la location ?',
                'choice_label' => 'label',
                'expanded' => true,
                'multiple' => false
            ])
            ->add('users', EntityType::class, [
                'class' => Users::class,
                'required' => false,
                'label' => 'Propriétaire (si nécessaire)',
                'choice_label' => 'username',
                'multiple' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rentings::class,
        ]);
    }
}
