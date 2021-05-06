<?php

namespace App\Form;

use App\Entity\Agence;
use App\Entity\Test;
use App\Entity\Utilisateur;
use App\EventSubscriber\renderSelectFieldSubscriber;
use App\Repository\AgenceRepository;
use App\Repository\TestRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegistrationFormType extends AbstractType
{
    private $em;
    private $agenceRepository;
    private $testRepository;


    public function __construct(EntityManagerInterface $em, AgenceRepository $agenceRepository, TestRepository $testRepository)
    {
        $this->em = $em;
        $this->agenceRepository = $agenceRepository;
        $this->testRepository = $testRepository;
    }
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
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
            ->add('email', TextType::class, [
                'label' => 'Email :'
            ])
            ->add('role', ChoiceType::class, [
                'mapped'    => false,
                'choices'   => [
                    'Client'            => 'ROLE_USER',
                    'Consultant'        => 'ROLE_CONSULTANT',
                    'Administrateur'    => 'ROLE_ADMIN',
                ]
            ])
            ->add('agence', EntityType::class, [
                'class'         => Agence::class,
                'choice_label'  => 'nom',
                'label' => 'Agence :',
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
