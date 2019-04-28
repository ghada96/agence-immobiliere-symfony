<?php

namespace App\Form;

use App\Entity\Buy;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BuyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('surface')
            ->add('rooms')
            ->add('bedroom')
            ->add('floor')
            ->add('price')
            ->add('chauffage')
            ->add('city')
            ->add('address')
            ->add('codepostal')
            ->add('sold')
            ->add('created_at')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Buy::class,
        ]);
    }
}
