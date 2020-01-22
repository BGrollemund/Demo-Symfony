<?php

namespace App\Form;

use App\Entity\Guests;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GuestsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('last_name', null, [
                'label' => 'Nom'
            ])
            ->add('first_name', null, [
                'label' => 'Prénom'
            ])
            ->add('email', null, [
                'label' => 'e-mail'
            ])
            ->add('phone_number', null, [
                'label' => 'Téléphone'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Guests::class,
        ]);
    }
}
