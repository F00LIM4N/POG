<?php

namespace App\Form;

use App\Entity\Game;
use App\Entity\Promo;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;


class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name_game')
            ->add('releaseDate_game')
            ->add('picture_game')
            ->add('price_game')
            ->add('note_game')
            ->add('isAvailable')
            ->add('promo')
            ->add('development')
            ->add('edition')
            ->add('pegi')
            ->add('category')
            ->add('gamemode')
            ->add('gameorder')
            ->add('platform');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
