<?php


namespace App\Form;


use Craue\FormFlowBundle\Form\FormFlow;

class savORIENTFlowType extends FormFlow
{
    protected $revalidatePreviousSteps = false;

    protected function loadStepsConfig() {
        return [
            [
                'label' => 'Step 1',
                'form_type' => savORIENTType::class,
            ],
            [
                'label' => 'Step 2',
                'form_type' => savORIENTType::class,
            ],
            [
                'label' => 'Step 3',
                'form_type' => savORIENTType::class,
            ],
            [
                'label' => 'Step 4',
                'form_type' => savORIENTType::class,
            ],
            [
                'label' => 'Step 5',
                'form_type' => savORIENTType::class,
            ],
            [
                'label' => 'Step 6',
                'form_type' => savORIENTType::class,
            ],
            [
                'label' => 'Step 7',
                'form_type' => savORIENTType::class,
            ],
            [
                'label' => 'Step 8',
                'form_type' => savORIENTType::class,
            ],
        ];
    }
}