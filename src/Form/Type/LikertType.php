<?php

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\OptionsResolver\OptionsResolver;

class LikertType extends AbstractType
{
    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'choices' => [
                'left' => [
                    '+++ ' => '-3',
                    '++ ' => '-2',
                    '+' => '-1',
                ],
                'middle' => [
                    '0' => '0',
                ],
                'right' => [
                    '+' => '1',
                    '++' => '2',
                    '+++' => '3',
                ]
            ],
            'expanded'  => true,
        ]);
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }
}
