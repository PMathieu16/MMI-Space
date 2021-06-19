<?php
namespace App\Form;


use App\Data\SearchUser;
use App\Entity\Bac;
use App\Entity\FieldActivity;
use App\Entity\FieldStudy;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchUserType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('q', TextType::class, [
                'required' => false,
                'label' => false
            ])
            ->add('bac', EntityType::class, [
                'class' => Bac::class,
                'placeholder' => 'Baccalauréat',
                'required' => false,
                'expanded' => false,
            ])
            ->add('promo', IntegerType::class, [
                'required' => false,
                'label' => false,
            ])
            ->add('fieldStudy', EntityType::class, [
                'class' => FieldStudy::class,
                'placeholder' => "Domaine de poursuite d'étude",
                'required' => false,
                'expanded' => false,
            ])
            ->add('fieldActivity', EntityType::class, [
                'class' => FieldActivity::class,
                'placeholder' => "Domaine d'activité",
                'required' => false,
                'expanded' => false,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchUser::class,
            'method' => 'GET',
            'csrf_protection' => false,
        ]);
    }

    public function getBlockPrefix(): string
    {
        return '';
    }
}
