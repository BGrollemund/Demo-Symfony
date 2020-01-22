<?php

namespace App\Form;

use App\Entity\Roles;
use App\Entity\Users;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UsersEditType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', null, [
                'label' => 'Nom d\'utilisateur'
            ])
            ->add('role', EntityType::class, [
                'class' => Roles::class,
                'required' => true,
                'label' => 'Rôle',
                'choice_label' => function ($role) {
                    return $role->getProperLabel();
                },
                'multiple' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Users::class,
        ]);
    }
}
