<?php

namespace App\Form;

use App\Entity\Game;
use App\Entity\Editor;
use App\Entity\Hardware;
use App\Entity\Genre;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GameType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'label'=>'Nom'
                ]
            ])
            ->add('year', NumberType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'label'=>'Date de sortie'
                ]
            ])
            ->add('genre', EntityType::class,[
                'label'=>'Genre',
                'class' => Genre::class,
                'choice_label'=>"name",
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('hardware', EntityType::class,[
                'label'=>'Console',
                'class' => Hardware::class,
                'choice_label'=>"name",
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
            ->add('editor', EntityType::class,[
                'label'=>'Editeur',
                'class' => Editor::class,
                'choice_label'=>"name",
                'attr'=>[
                    'class'=>'form-control'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Game::class,
        ]);
    }
}
