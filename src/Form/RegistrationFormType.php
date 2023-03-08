<?php

namespace App\Form;

use App\Entity\Twofa;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email', EmailType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'E-mail'
            ])
            ->add('lastname', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Nom',
                'constraints' => [
                    new Regex([
                        'pattern' => '/^[\p{L} -]*$/u',
                        'message' => 'Le nom ne doit contenir que des lettres'
                    ])
                ],
            ])
            ->add('firstname', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Prénom',
                'constraints' => [
                    new Regex([
                        'pattern' => '/^[\p{L}-]*$/u',
                        'message' => 'Le prénom ne doit contenir que des lettres'
                    ])
                ],
            ])
            ->add('pseudo', TextType::class, [
                'attr' => [
                    'class' => 'form-control'
                ],
                'constraints' => [
                    new Length([
                        'min' => 3,
                        'minMessage' => 'Le pseudo doit contenir au moins {{ limit }} caractères',
                    ]),
                ]
            ])
            ->add('address', AddressType::class, [
                'label' => false
            ])

            ->add('date_birth', BirthdayType::class, [
                'widget' => 'single_text',
                'format' => 'yyyy-MM-dd',
                'attr' => [
                    'class' => 'form-control'
                ],
                'label' => 'Date de naissance'
            ])
            ->add('phone', TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'placeholder' => 'Optionnel'
                ],
                'label' => 'Téléphone',
                'required' => false
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'attr' => [
                    'class' => 'form-check-input'
                ],
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Vous devez accepter pour pouvoir valider l\'inscription',
                    ]),
                ],
                'label' => 'En cochant cette case, j\'accepte les conditions d\'utilisation du site POG.'
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
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => [
                    'autocomplete' => 'new-password',
                    'class' => 'form-control'
                ],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Merci de rentrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 8,
                        'minMessage' => 'Votre mot de passe doit contenir au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
                    ]),
                    new Regex([
                        'pattern' => '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*(_|[^\w])).+$/',
                        'message' => 'Votre mot de passe doit contenir au moins une lettre en minuscule, une majuscule, un chiffre et un caractère spécial'
                    ]),
                ],
            ])


            // Champs remplis automatiquement
            ->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
                $form = $event->getForm();
                $user = $form->getData();

                $token = $user->getToken();

                if (empty($token)) {
                    // Générer une chaîne aléatoire de longueur aléatoire entre 20 et 200 caractères
                    $length = mt_rand(20, 200);
                    $token = bin2hex(random_bytes($length));
                    // Assigner la valeur de la chaîne aléatoire au champ "token" de l'objet User
                    $user->setToken($token);
                }
            });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
