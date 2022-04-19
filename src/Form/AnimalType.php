<?php

namespace App\Form;

use App\Entity\Animal;
use App\Entity\Chenille;
use App\Entity\Proprio;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AnimalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('race')
            ->add('proprio', EntityType::class, [
                'class' => Proprio::class,
                'choice_label' => 'nom'
            ])
            ->add('chenille', EntityType::class, [
                'class' => Chenille::class,
                'choice_label' => 'nom'
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Animal::class,
        ]);
    }
}
