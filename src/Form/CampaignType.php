<?php

namespace App\Form;

use App\Entity\Campaign;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CampaignType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => ['type' => 'text',
                           'class' => 'validate'],
                'label' => 'Votre Nom',
            ])
            ->add('email', EmailType::class, [
                'attr' => ['class' => 'validate']
            ])
            ->add('title', TextType::class, [
                'attr' => ['class' => 'validate'],
                'label' => 'Titre de votre campagne',
            ])
            ->add('content', TextareaType::class, [
                'attr' => ['class' => 'materialize-textarea',
                           'placeholder' => "Décrivez à vos amis pourquoi vous faites une campagne" ]
            ])
            ->add('goal', NumberType::class, [
                'attr' => ['class' => 'validate'],
                'label' => 'Votre objectif en euros'
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Campaign::class,
        ]);
    }
}
