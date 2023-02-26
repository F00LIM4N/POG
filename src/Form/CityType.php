<?php

namespace App\Form;

use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\City;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Regex;

class CityType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name_city', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Ville',
                'constraints' => [
                    new Regex([
                        'pattern' => '/^[\p{L} \'-]*$/u',
                        'message' => 'Ce champ ne doit contenir que des lettres.'
                    ])
                ]
            ])
            ->add('country', CountryType::class, [
                'label' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => City::class,
        ]);
    }
}
