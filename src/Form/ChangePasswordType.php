<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;

class ChangePasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('old_password', PasswordType::class, [
                'mapped' => false,
            ])
            ->add('new_password', RepeatedType::class,[
                'type' => PasswordType::class,
                'mapped' => false,
                'invalid_message' => 'Le Mdp et la confirmation doivent etre identiques',
                'required' => true,
                'first_options' => [
                    'label' => 'Mon nouveau mot de passe',
                                    ],
                 'second_options' => [
                    'label' => 'Confirmer votre nouveau mot de passe'
                 ]                   
            ])
            ->add('firstname')
            ->add('lastname')

            ->add('submit', SubmitType::class, [
                'label' => "Mettre A Jour"
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
