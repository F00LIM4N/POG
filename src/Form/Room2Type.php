<?php

namespace App\Form;

use App\Entity\Room;
use App\Entity\User;
use DateTime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class Room2Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title_room', TextType::class, [
                'label' => 'Titre',
                'attr' => [
                    'class' => 'form-control'
                ],
            ])
            ->add('content_room')
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choices' => [$options['user']],
                'choice_label' => function ($user) {
                    return $user->getId();
                },
                'attr' => ['style' => 'display:none;']
            ])
            ->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
                $form = $event->getForm();
                $room = $form->getData();

                $date = $room->getDateRoom();

                if (empty($date)) {
                    $date = new DateTime();
                    $room->setDateRoom($date);
                }

            });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Room::class,
        ]);
        // Ajouter votre option 'user' ici => user de Room
        $resolver->setRequired('user');
    }
}
