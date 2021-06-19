<?php

namespace App\Form;

use App\Entity\Bac;
use App\Entity\FieldActivity;
use App\Entity\FieldStudy;
use App\Entity\Salary;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email',EmailType::class)

            ->add('password',PasswordType::class,[
                'always_empty' => false,
            ])

            ->add('firstName',TextType::class)

            ->add('lastName',TextType::class)

            ->add('imageFile', VichImageType::class,[
                'required' => false,
                'allow_delete' => false,
                'asset_helper' => true,
            ])

            ->add('promo', IntegerType::class)


            ->add('fieldStudy', EntityType::class,[
                'class' => FieldStudy::class,
                'required' => false,
            ])

            ->add('bestDegree', ChoiceType::class,[
                'choices'=>[
                    'Bac +2'=>'Bac +2',
                    'Bac +3'=>'Bac +3',
                    'Bac +4'=>'Bac +4',
                    'Bac +5'=>'Bac +5',
                    'Bac +6'=>'Bac +6',
                    'Bac +7'=>'Bac +7',
                    'Bac +8'=>'Bac +8',
                ],
                'required' => false,
            ])

            ->add('curStatus', ChoiceType::class,[
                'choices'=>[
                    'CDD'=>'CDD',
                    'CDI'=>'CDI',
                    'Sans emploi'=>'Sans emploi',
                ],
                'required' => false,
            ])

            ->add('linkedin', UrlType::class,[
                'required' => false,
            ])
            ->add('instagram', UrlType::class,[
                'required' => false,
            ])
            ->add('portfolio', UrlType::class,[
                'required' => false,
            ])
            ->add('facebook', UrlType::class,[
                'required' => false,
            ])
            ->add('job', TextType::class,[
                'required' => false,
            ])
            ->add('zoneActivity', TextType::class,[
                'required' => false,
            ])
            ->add('status', TextType::class,[
                'required' => false,
            ])
            ->add('description', TextareaType::class,[
                'required' => false,
            ])
            ->add('company', TextType::class,[
                'required' => false,
            ])
            ->add('behance', UrlType::class,[
                'required' => false,
            ])
            ->add('profession', TextType::class,[
                'required' => false,
            ])
            ->add('bac', EntityType::class, [
                'class' => Bac::class,
            ])
            ->add('salary', EntityType::class,[
                'class' => Salary::class,
                'required' => false,
            ])
            ->add('fieldActivity', EntityType::class,[
                'class' => FieldActivity::class,
                'required' => false,
            ])
            ->add('save',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
