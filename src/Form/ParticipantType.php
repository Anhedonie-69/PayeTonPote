<?php

namespace App\Form;

use App\Entity\Campaign;
use App\Entity\Participant;
use App\Entity\Payment;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ParticipantType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('email', EmailType::class)
            ->add('isIdentityHidden', CheckboxType::class, [
                'required' => false,
                'label' => 'Masquer mon identité auprès des autres participants',
            ])
            ->add('isAmountHidden', CheckboxType::class, [
                'required' => false,
                'label' => 'Masquer le montant de ma participation auprès des autres participants',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Participant::class,
        ]);
    }
}
