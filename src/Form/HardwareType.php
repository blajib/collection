<?php

namespace App\Form;

use App\Entity\Hardware;
use App\Entity\Hardwaremaker;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class HardwareType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name',TextType::class,[
                'attr'=>[
                    'class'=>'form-control',
                    'label'=>'Nom de la console'
                ]
            ])
            ->add('year', NumberType::class, [
                'attr' => [
                    'class' => 'form-control',
                    'label'=>'Date de sortie'
                ]
            ])
            /*->add('imageLink')*/
            ->add('hardwaremaker', EntityType::class,[
                'label'=>'Consolier',
                'class' => Hardwaremaker::class,
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
            'data_class' => Hardware::class,
        ]);
    }
}
