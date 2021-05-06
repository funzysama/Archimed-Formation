<?php


namespace App\EventSubscriber;


use App\Entity\Test;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;

class renderSelectFieldSubscriber implements EventSubscriberInterface
{

    public static function getSubscribedEvents()
    {
        return [FormEvents::PRE_SUBMIT => 'onPreSubmit'];
    }

    function onPreSubmit(FormEvent $event) {
        $form = $event->getForm();
        dump($form);
    }

    protected function addTestElements(FormInterface $form, Test $test = null) {
        $form->add('tests', EntityType::class, [
            'label' => 'Tests incrits d\'office :',
            'multiple' => true,
            'expanded' => true,
            'class' => Test::class,
            'choice_label' => 'nom'
        ]);
    }


}