<?php

namespace App\Form;

use App\Entity\Address;
use App\Entity\Role;
use App\Entity\Twofa;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('lastname_user', TextType::class, [
                'label' => 'Nom de famille'
            ])
            ->add('firstname_user', TextType::class, [
                'label' => 'Prénom'
            ])
            ->add('email_user', EmailType::class, [
                'label' => 'Email'
            ])
            ->add('password_user', PasswordType::class, [
                'label' => 'Mot de passe'
            ])
            ->add('pseudo_user', TextType::class, [
                'label' => 'Pseudo'
            ])
            ->add('dateBirth_user', DateType::class, [
                'label' => 'Date de naissance'
            ])
            ->add('description_user', TextType::class, [
                'label' => 'Description'
            ])
            ->add('picture_user', TextType::class, [
                'label' => 'Photo de profil'
            ])
            ->add('isMailValid', CheckboxType::class, [
                'label' => 'Mail validé ?'
            ])
            ->add('phone_user', TextType::class, [
                'label' => 'Téléphone'
            ])
            ->add('secu_enabled_user', CheckboxType::class, [
                'label' => 'Sécurité appliquée ?'
            ])
            ->add(
                'role',
                EntityType::class, [
                    'class' => Role::class,
                    'choice_label' => 'name_role',
                ])
            ->add('address', EntityType::class, [
                'class' => Address::class,
                'choice_label' => 'name_address',
            ])
            ->add('authentification', EntityType::class, [
                'class' => Twofa::class,
                'choice_label' => 'method_authentification',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
