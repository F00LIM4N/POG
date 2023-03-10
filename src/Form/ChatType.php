<?php

namespace App\Form;

use App\Entity\User;
use App\Entity\Chat;
use App\Entity\Room;
use DateTime;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('commentary')
            ->add('user', EntityType::class, [
                'class' => User::class,
                'attr' => ['style' => 'display:none;']
            ])
            ->add('room', EntityType::class, [
                'class' => Room::class,
                'attr' => ['style' => 'display:none;']
            ])

            ->addEventListener(FormEvents::SUBMIT, function (FormEvent $event) {
                $form = $event->getForm();
                $chat = $form->getData();

                $date = $chat->getDate();
                if (empty($date)) {
                    $date = new DateTime();
                    $chat->setDate($date);
                }

            });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chat::class,
        ]);
    }
}
