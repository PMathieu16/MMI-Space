<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MailType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'placeholder' => 'Adresse mail'
                ]
            ])
            ->add("isEduc",ChoiceType::class,[
                'choices'  => [
                    'Non' => 0,
                    'Oui' => 1,
                ],
            ])
            ->add('save', SubmitType::class, [
                'label' => 'Envoyer le mail',
                'attr' => [
                    'class' => 'form__button',
                ]

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Configure your form options here
        ]);
    }
}
