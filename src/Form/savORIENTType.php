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

class savORIENTType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        $questions = $options["questions"];
        $sexe = $options['sexe'];
        if($questions != null){
            switch ($options['flow_step']) {
                case 1:
                    for ($i = 0; $i < 12; $i++){
                        $intitule = $questions[$i]->getIntituler();
                        $questionArray = $this->splitQuestion($intitule);
                        $questionIntituler = $questionArray[0];
                        unset($questionArray[0]);
                        $questionChoices = array_values($questionArray);
                        if(isset($questionChoices[5])){
                            unset($questionChoices[5]);
                        }
                        $builder->add('Question'.($i+1), ChoiceType::class,[
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
                    }
                    break;
                case 2:
                    for ($i = 12; $i < 24; $i++){
                        $intitule = $questions[$i]->getIntituler();
                        $questionArray = $this->splitQuestion($intitule);
                        $questionIntituler = $questionArray[0];
                        unset($questionArray[0]);
                        $questionChoices = array_values($questionArray);
                        $builder->add('Question'.($i+1), ChoiceType::class,[
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
                    }
                    break;
                case 3:
                    for ($i = 24; $i < 36; $i++){
                        $intitule = $questions[$i]->getIntituler();
                        $questionArray = $this->splitQuestion($intitule);
                        $questionIntituler = $questionArray[0];
                        unset($questionArray[0]);
                        $questionChoices = array_values($questionArray);
                        $builder->add('Question'.($i+1), ChoiceType::class,[
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
                    }
                    break;
                case 4:
                    for ($i = 36; $i < 48; $i++){
                        $intitule = $questions[$i]->getIntituler();
                        $questionArray = $this->splitQuestion($intitule);
                        $questionIntituler = $questionArray[0];
                        unset($questionArray[0]);
                        $questionChoices = array_values($questionArray);
                        $builder->add('Question'.($i+1), ChoiceType::class,[
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
                    }
                    break;
                case 5:
                    for ($i = 48; $i < 60; $i++){
                        $intitule = $questions[$i]->getIntituler();
                        $questionArray = $this->splitQuestion($intitule);
                        $questionIntituler = $questionArray[0];
                        unset($questionArray[0]);
                        $questionChoices = array_values($questionArray);
                        $builder->add('Question'.($i+1), ChoiceType::class,[
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
                    }
                    break;
                case 6:
                    for ($i = 60; $i < 72; $i++){
                        $intitule = $questions[$i]->getIntituler();
                        $questionArray = $this->splitQuestion($intitule);
                        $questionIntituler = $questionArray[0];
                        unset($questionArray[0]);
                        $questionChoices = array_values($questionArray);
                        $builder->add('Question'.($i+1), ChoiceType::class,[
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
                    }
                    break;
                case 7:
                    for ($i = 72; $i < 84; $i++){
                        $intitule = $questions[$i]->getIntituler();
                        $questionArray = $this->splitQuestion($intitule);
                        $questionIntituler = $questionArray[0];
                        unset($questionArray[0]);
                        $questionChoices = array_values($questionArray);
                        $builder->add('Question'.($i+1), ChoiceType::class,[
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
                    }
                    break;
                case 8:
                    for ($i = 84; $i < 93; $i++){
                        $intitule = $questions[$i]->getIntituler();
                        $questionArray = $this->splitQuestion($intitule);
                        $questionIntituler = $questionArray[0];
                        unset($questionArray[0]);
                        $questionChoices = array_values($questionArray);
                        $builder->add('Question'.($i+1), ChoiceType::class,[
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
                    }
                    break;
            }
            if($sexe === "M"){
                $builder->add('Question0', HiddenType::class, [
                    'mapped'    => false,
                    'attr'  => [
                        'value' => 0,
                        'style' => 'display: hidden'
                    ]
                ]);
            }else{
                $builder->add('Question0', HiddenType::class, [
                    'mapped'    => false,
                    'attr'  => [
                        'value' => 1,
                        'style' => 'display: hidden'
                    ]
                ]);
            }
        }
//        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) use ($options) {
//
//            $form = $event->getForm();
//            $questions = $options["questions"];
//            dump($questions);
//
//        });
    }

    public function getBlockPrefix(): string
    {
        return 'Positioning_Skills';
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'questions' => null,
            'sexe'      => null,
        ]);
    }

    private function splitQuestion($question)
    {
        return preg_split('/\r\n/', $question);
    }
}
