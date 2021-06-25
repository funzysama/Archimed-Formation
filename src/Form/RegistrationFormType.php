<?php

namespace App\Form;

use App\Entity\Agence;
use App\Entity\Module;
use App\Entity\Utilisateur;
use App\EventSubscriber\renderSelectFieldSubscriber;
use App\Repository\AgenceRepository;
use App\Repository\TestRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\Options;
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
                    'M.' => 'M',
                    'Mme' => 'F',
                    ],
                'row_attr' => [
                    'class' => 'd-flex flex-md-row justify-content-around sexeContainer'
                ],
                'label'     => 'Sexe: ',
                'expanded' => true,
                'multiple' => false
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
            ->add('nom', TextType::class, [
                'attr' => [
                    'placeholder' => 'Nom...',
                ],
                'row_attr' => [
                    'class' => 'd-flex col-sm-12'
                ],
            ])
            ->add('dateDeNaissance', DateType::class,[
                'label'     => 'Date de naissance: ',
                'widget' => 'single_text',
                'html5' => false,
                'required' => false,
                'row_attr' => ['class' => 'dateDeNaissance'],
                'attr' => ['class' => 'js-datepicker'],
                ])
            ->add('email', EmailType::class, [
                'label' => 'Email :',
                'attr' => [
                    'placeholder' => 'Email...',
                ],
                'row_attr' => [
                    'class' => 'd-flex col-sm-12'
                ],
            ]);
        if(in_array('ROLE_ADMIN', $user->getRoles())){
            $builder->add('role', ChoiceType::class, [
                'placeholder' => 'Selectionner un role...',
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
            ])
                ->add('consultant', EntityType::class, [
                    'placeholder'       => 'Choisissez un consultant...',
                    'class'             => Utilisateur::class,
                    'required'      => false,
                    'choice_label'      => function (Utilisateur $utilisateur) {
                        return $utilisateur->getNom() . ' ' . $utilisateur->getPrenom();
                    },
                    'query_builder' => function (EntityRepository $er) {
                            return $er->createQueryBuilder('u')
                                ->orWhere('u.roles = :role1')
                                ->orWhere('u.roles = :role2')
                                ->setParameters([
                                    'role1' => '["ROLE_ADMIN"]',
                                    'role2' => '["ROLE_CONSULTANT"]'
                                ]);
                    }
                ])
            ;
        }
        $builder->add('agence', EntityType::class, [
                'placeholder'   => 'Sélectionner une agence...',
                'class'         => Agence::class,
                'choice_label'  => 'nom',
                'row_attr'      => [
                    'class'     => 'd-flex col-sm-12'
                ],
            ])
            ->add('profession', TextType::class, [
                'required'  => false,
                'attr'  => [
                    'placeholder'   => 'Profession...'
                ]
            ])
            ->add('qualification', ChoiceType::class, [
                'placeholder' => 'Qualification...',
                'required'  => false,
                'choices'   => [
                    'Sans qualification'    => 'aucune',
                    'CAP/BEP'               => 'CAP/BEP',
                    'BAC'                   => 'BAC',
                    'BAC+2'                 => 'BAC+2',
                    'BAC+3'                 => 'BAC+3',
                    'BAC+5 et +'            => 'BAC+5',
                ],
            ])
            ->add('module', EntityType::class, [
                'class'     => Module::class,
                'required' => false,
                'choice_label'  => 'Nom',
                'placeholder'   => 'Selectionner un module...'
            ])
            ->add('authResultI3P', CheckboxType::class, [
                'label' => 'Resultat I3P',
                'required'      => false,
            ])
            ->add('authResultRiasec', CheckboxType::class, [
                'label' => 'Resultat Riasec',
                'required'      => false,
           ])
            ->add('authResultPositioning', CheckboxType::class, [
                'label' => 'Resultat Positioning Skills',
                'required'      => false,
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
