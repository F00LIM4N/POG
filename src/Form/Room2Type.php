<?php

namespace App\Form;

use App\Entity\Room;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class Room2Type extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title_room')
            ->add('date_room', DateTimeType::class, array(
                'html5' => false, // Désactive l'option "html5"
                'format' => 'dd-MM-yyyy HH:mm',
                'data' => new \DateTime()
            ))
            ->add('content_room')
            ->add('user', EntityType::class, [
                'class' => User::class,
                'choices' => [$options['user']],
                'choice_label' => function ($user) {
                    return $user->getId();
                },
            ]);
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
