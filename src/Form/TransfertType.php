<?php

namespace App\Form;

use App\Entity\Transfert;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use  Symfony\Component\Form\Extension\Core\Type\DateType;

class TransfertType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('destinataire')
            ->add('hostname')
            ->add('serialnumber')
            ->add('dateTransfert', DateType::class, array(
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                ))
            ->add('commentaire')
            ->add('qte')
            ->add('materiel')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Transfert::class,
        ]);
    }
}
