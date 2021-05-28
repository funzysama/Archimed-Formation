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
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
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
                'expanded' => true,
                'multiple' => false
            ])
            ->add('nom', TextType::class, [
                'label' => 'Nom :'
            ])
            ->add('prenom', TextType::class, [
                'label' => 'Prénom :'
            ])
            ->add('email', EmailType::class, [
                'label' => 'Email :'
            ]);
        if(in_array('ROLE_ADMIN', $user->getRoles())){
            $builder->add('role', ChoiceType::class, [
                'mapped'    => false,
                'choices'   => [
                    'Client'            => 'ROLE_USER',
                    'Consultant'        => 'ROLE_CONSULTANT',
                    'Administrateur'    => 'ROLE_ADMIN',
                ],
                'empty_data' => 'ROLE_USER'
            ]);
        }
        $builder->add('agence', EntityType::class, [
                'class'         => Agence::class,
                'choice_label'  => 'nom',
                'label' => 'Agence :',
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
        $builder->addEventSubscriber(new renderSelectFieldSubscriber());
    }


    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Utilisateur::class,
        ]);
    }
}
