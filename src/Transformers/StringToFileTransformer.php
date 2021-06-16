<?php

namespace App\Transformers;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\HttpFoundation\File\File;

class StringToFileTransformer implements DataTransformerInterface
{
    private $uploadDir;

    function __construct($uploadDir)
    {
        $this->uploadDir = $uploadDir;
    }

    /**
     * @inheritDoc
     */
    public function transform($value)
    {
        if(is_string($value)){
            $dir = str_replace('/', '\\', $this->uploadDir);
            $file =  new File($dir.'\\'.$value);
            return $file;
        }
        return $value;
    }

    /**
     * @inheritDoc
     */
    public function reverseTransform($value)
    {
        dump($value);
    }
}