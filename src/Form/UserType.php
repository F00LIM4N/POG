<?php

namespace App\Form;

use App\Entity\Twofa;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\File;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('description')
            ->add('phone', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                ],
                'label' => 'Téléphone',
                'required' => false
            ])
            ->add('address', AddressType::class, [
                'label' => false
            ])
            ->add('authentification', EntityType::class, [
                'class' => Twofa::class,
                'attr' => [
                    'class' => 'form-select'
                ],
                'choice_label' => 'method_authentification',
                'placeholder' => 'Choisir une méthode',
                'label' => 'Méthode d\'authentification'
            ])
            ->add('picture', FileType::class, [
                'label' => 'Image de profil',
                'attr' => [
                    'class' => 'form-control',
                ],

                // unmapped means that this field is not associated to any entity property
                'mapped' => false,

                // make it optional so you don't have to re-upload the PDF file
                // every time you edit the Product details
                'required' => false,

                // unmapped fields can't define their validation using annotations
                // in the associated entity, so you can use the PHP constraint classes
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/jpg',
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => "Merci de choisir un format d'image valide",
                    ])
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
