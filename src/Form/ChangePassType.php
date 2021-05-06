<?php


namespace App\Form;


use App\Entity\Utilisateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ChangePassType
    extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('Password', RepeatedType::class, [
                'type'              => PasswordType::class,
                'options'           => [
                    'row_attr'          => [
                        'class'         => 'changePassForm-item'
                    ],
                    'label_attr'    => [
                        'class' => 'changePassForm-label'
                    ],
                                    'attr'          => [
                        'class' => 'changePassForm-input'
                    ]
                ],
                'invalid_message'   => 'Les deux mot de passe doivent êtres identiques.',
                'required'          => true,
                'first_options'     =>  [
                    'label'         =>  'Mot de Passe :',
                ],
                'second_options'    => [
                    'label' =>  'Confirmation : ',
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
