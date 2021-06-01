<?php

namespace App\Form;

use App\Form\Type\LikertType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class I3PType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {

            $form = $event->getForm();
            $questions = $event->getForm()->getConfig()->getOptions()['questions'];
            $testName = $questions[0]->getTest()->getNom();
            $sexe = $event->getForm()->getConfig()->getOptions()['sexe'];

            if($questions != null){
                $j = 1;
                for ($i = 0; $i < count($questions); $i++){
                    $intitule = $questions[$i]->getIntituler();
                    $questionArray = preg_split('/\r\n/', $intitule);
                    $questionIntituler = $questionArray[0];
                    unset($questionArray[0]);
                    $questionChoices = array_values($questionArray);
                    $form->add('Question'.$j, ChoiceType::class,[
                        'row_attr' => [
                            'class' => 'col-sm-12'
                        ],
                        'attr' => [
                            'class' => 'col-sm-12'
                        ],
                        'label' => $questionIntituler,
                        'label_attr' => [
                            'class' => 'col-sm-12 text-center'
                        ],
                        'choices' => array_flip($questionChoices),
                        'multiple' => false,
                        'expanded'  => true,
                    ]);
                    $j++;
                }
                if($sexe === "M"){
                    $form->add('Question0', HiddenType::class, [
                        'attr'  => [
                            'value' => 0,
                            'style' => 'display: hidden'
                        ]
                    ]);
                }else{
                    $form->add('Question0', HiddenType::class, [
                        'attr'  => [
                            'value' => 1,
                            'style' => 'display: hidden'
                        ]
                    ]);
                }
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
