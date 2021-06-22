<?php

namespace App\Form;

use App\Form\Type\LikertType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class IRMRType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {

            $form = $event->getForm();
            $questions = $event->getForm()->getConfig()->getOptions()['questions'];
            $sexe = $event->getForm()->getConfig()->getOptions()['sexe'];
            if($questions != null){
                $j = 1;
                for ($i = 0; $i < count($questions); $i++){
                    $intitule = $questions[$i]->getIntituler();
                    $form->add('Question'.$j, LikertType::class, [
                        'attr'          => [
                            'class'     => 'inputsContainer marginTop1 col-sm-12'
                        ],
                        'row_attr'      => [
                            'class'     => 'question-row marginTop1 card',
                            'id'        => 'question'.$j
                        ],
                        'label'         => $intitule,
                        'label_attr'    => [
                            'class'     => 'questionLabel'
                        ]
                    ]);
                    $j++;
                }
                if($sexe === "M"){ $form->add('Question0', HiddenType::class, ['attr'  => ['value' => 0]]); }
                else{ $form->add('Question0', HiddenType::class, ['attr'  => ['value' => 1]]); }
                $form->add('Valider', SubmitType::class);
            }
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'questions' => null,
            'sexe'      => null
        ]);
    }
}
