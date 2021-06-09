<?php

namespace App\Form;

use App\Entity\Module;
use App\Entity\Test;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ModuleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom',TextType::class, ['label'=>'Nom du Module: ']);
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event){
            $data = $event->getData();
            $form = $event->getForm();
            $folderString = $data->getDossier();
            $folderArray = explode("/", $folderString);
            if(!$data->getId()){
                $form->add('dossier', TextType::class, [
                    'label'     => 'Nom du Dossier:',
                    'mapped'    => false,
                ]);
            }else{
                $form->add('dossier', TextType::class, [
                    'label'     => 'Nom du Dossier:',
                    'mapped'    => false,
                    'data'      => $folderArray[4]
                ]);
            }
        });
        $builder->add('testsInscrits', EntityType::class, [
            'label'             => 'Tests Inscrit d\'office',
            'mapped'            => false,
            'class'             => Test::class,
            'choice_label'      => 'nomVisuel',
            'attr'              => [
                'multiple'      => true
            ]
        ]);

    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Module::class,
        ]);
    }
}
