<?php

namespace App\Form;

use App\Entity\Cartouche;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use  Symfony\Component\Form\Extension\Core\Type\DateType;

class CartoucheType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('date', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                ))
            ->add('nomPersonne')
            ->add('referenceCartouche')
            ->add('qte')
            ->add('departement')
            ->add('couleur')
            ->add('fournisseur')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Cartouche::class,
        ]);
    }
}
