<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastname_user')
            ->add('firstname_user')
            ->add('email_user')
            ->add('password_user')
            ->add('token_user')
            ->add('pseudo_user')
            ->add('dateBirth_user')
            ->add('description_user')
            ->add('picture_user')
            ->add('isMailValid')
            ->add('phone_user')
            ->add('secu_enabled_user')
            ->add(
                'role',
                ChoiceType::class,
                array(
                    'attr'  =>  array(
                        'class' => 'form-control',
                    ),
                    'choices' =>
                    array(
                        'ROLE_ADMIN' => array(
                            'Yes' => 'ROLE_ADMIN',
                        ),
                        'ROLE_TEACHER' => array(
                            'Yes' => 'ROLE_USER'
                        ),
                    ),
                    'required' => true,
                )
            )
            ->add('address', TextType::class)
            ->add('authentification', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
