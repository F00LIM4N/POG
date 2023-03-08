<?php

namespace App\Form;

use App\Entity\Chat;
use App\Entity\Room;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class ChatType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('commentary')
            ->add('date', DateTimeType::class, array(
                'html5' => false, // Désactive l'option "html5"
                'format' => 'dd-MM-yyyy HH:mm',
                'data' => new \DateTime()
            ))
            ->add('user')
            ->add('room');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Chat::class,
        ]);
    }
}
