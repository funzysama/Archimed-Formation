<?php

namespace App\Form;

use App\Entity\Agence;
use App\Entity\Utilisateur;
use App\EventSubscriber\renderSelectFieldSubscriber;
use App\Repository\AgenceRepository;
use App\Repository\TestRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class RegistrationFormType extends AbstractType
{
    private $em;
    private $agenceRepository;
    private $testRepository;
    private $tokenStorage;


    public function __construct(
        EntityManagerInterface $em,
        AgenceRepository $agenceRepository,
        TestRepository $testRepository,
        TokenStorageInterface $tokenStorage
    )
    {
        $this->em = $em;
        $this->agenceRepository = $agenceRepository;
        $this->testRepository = $testRepository;
        $this->tokenStorage = $tokenStorage;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = $this->tokenStorage->getToken()->getUser();
        $builder
            ->add('sexe', ChoiceType::class, [
                'choices' => [
                    'Mr' => 'M',
                    'Mme' => 'F',
                    ],
                'row_attr' => [
                    'class' => 'd-flex flex-md-row justify-content-around sexeContainer'
                ],
                'label'     => 'Sexe: ',
                'expanded' => true,
                'multiple' => false
            ])
            ->add('nom', TextType::class, [
                'attr' => [
                    'placeholder' => 'Nom...',
                ],
                'row_attr' => [
                    'class' => 'd-flex col-sm-12'
                ],
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom :',
                'attr' => [
                    'placeholder' => 'Prénom...',
                ],
                'row_attr' => [
                    'class' => 'd-flex col-sm-12'
                ],
            ])
            ->add('dateDeNaissance', DateType::class,[
                'label'     => 'Date de naissance: ',
                'widget' => 'single_text',
                'html5' => false,
                'row_attr' => ['class' => 'dateDeNaissance'],
                'attr' => ['class' => 'js-datepicker'],
                ])
            ->add('email', EmailType::class, [
                'label' => 'Email :',
                'attr' => [
                    'placeholder' => 'Email...',
                    'class'       => 'dsq'
                ],
                'row_attr' => [
                    'class' => 'd-flex col-sm-12'
                ],
            ]);
        if(in_array('ROLE_ADMIN', $user->getRoles())){
            $builder->add('role', ChoiceType::class, [
                'placeholder' => 'Selectionner un role...',
                'mapped'    => false,
                'choices'   => [
                    'Client'            => 'ROLE_USER',
                    'Consultant'        => 'ROLE_CONSULTANT',
                    'Administrateur'    => 'ROLE_ADMIN',
                ],
                'attr' => [
                ],
                'empty_data' => 'ROLE_USER',
                'row_attr' => [
                    'class' => 'd-flex col-sm-12'
                ],
            ]);
        }
        $builder->add('agence', EntityType::class, [
                'placeholder' => 'Sélectionner une agence...',
                'class'         => Agence::class,
                'choice_label'  => 'nom',
                'label' => 'Agence :',
                'row_attr' => [
                    'class' => 'd-flex col-sm-12'
                ],
            ])
            ->add('testsInscris', ChoiceType::class, [
                'mapped'    => false,
                'choices'   => [
                    'i3P' =>  'I3P',
                    'Riasec Flash 2' =>  'IRMR',
                    'Positioning Skills' =>  'savORIENT',
                    ],
                'row_attr' => [
                    'id'    =>  'testsInscris'
                ],
                'expanded'  => true,
                'multiple'  => true,
            ])
            ->add('resultatInscris', ChoiceType::class, [
                'mapped'    => false,
                'choices'   => [
                    'i3P' =>  'I3P',
                    'Riasec Flash 2' =>  'IRMR',
                    'Positioning Skills' =>  'savORIENT',
                    ],
                'row_attr' => [
                    'id'    =>  'resultatInscris'
                ],
                'expanded'  => true,
                'multiple'  => true,
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
