<?php

namespace App\Form;

use App\Entity\Question;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class QuestionType extends AbstractType
{
    private function addFields($data = null){

    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero')
        ;

        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event){
            $data = $event->getData();
            $form = $event->getForm();
            $intiString = $data->getIntituler();
            $intiArray = preg_split('/\r\n/', $intiString);
            if(!$data->getId()){
                $form->add('intituler', TextType::class, [
                    'mapped'    => false,
                    ])
                    ->add('choix1', TextType::class, [
                        'mapped'    => false
                    ])
                    ->add('choix2', TextType::class, [
                        'mapped'    => false
                    ]);
            }else{
                $form->add('intituler', TextType::class, [
                    'mapped'    => false,
                    'data'      => $intiArray[0]
                    ])
                    ->add('choix1', TextType::class, [
                        'mapped'    => false,
                        'data'      => $intiArray[1]
                   ])
                    ->add('choix2', TextType::class, [
                        'mapped'    => false,
                        'data'      => $intiArray[2]
                    ]);

            }
            $form->get('intituler')->setData('abcdef');
        });
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Question::class,
        ]);
    }
}
