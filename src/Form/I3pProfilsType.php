<?php

namespace App\Form;

use App\Entity\I3pProfils;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class I3pProfilsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ProfilPerso')
            ->add('ProfilPro')
            ->add('Valeurs')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => I3pProfils::class,
        ]);
    }
}
