<?php

namespace App\Form;

use App\Entity\Settings;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class SettingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('aboutus', TextType::class,['attr' => ['class'=> 'form-control input-default']])
            ->add('adresse', TextType::class,['attr' => ['class'=> 'form-control input-default']])
            ->add('email', TextType::class,['attr' => ['class'=> 'form-control input-default']])
            ->add('telephone', TextType::class,['attr' => ['class'=> 'form-control input-default']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Settings::class,
        ]);
    }
}
