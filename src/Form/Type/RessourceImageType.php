<?php


namespace App\Form\Type;


use App\Transformers\StringToFileTransformer;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RessourceImageType extends AbstractType
{


    private $image_dir;

    public function __construct(string $image_dir)
    {
        $this->image_dir = $image_dir;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $transformer = new StringToFileTransformer($this->image_dir);
        $builder->addViewTransformer($transformer);
    }

    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'invalid_message' => 'Le fichier séléctionner n\'est pas valide.',
        ]);
    }

    public function getParent()
    {
        return FileType::class;
    }

    public function getName()
    {
        return 'issue_selector';
    }
}