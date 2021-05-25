<?php

namespace App\Form;

use App\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ButtonType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero', NumberType::class, [
                'label' => 'Question N°:',
                'row_attr'  => [
                    'class' => 'numeroField'
                ]
            ])
            ->add('intituler', TextareaType::class, [
                'label' => 'Intituler :',
                'attr' => [
                    'class' => 'textArea',
                ]
            ])
            ->add('Ajouter', SubmitType::class, [
                'row_attr' => [
                    'class' => 'addButton'
                ]
            ])
            ->add('Annuler', ButtonType::class,[
                'row_attr' => [
                    'class' => 'cancelButton'
                ],
                'attr' => [
                    'type' => 'button'
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
