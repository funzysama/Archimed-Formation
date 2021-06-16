<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    /**
     * @Route("/test/{name}", name="test")
     */
    public function index($name): Response
    {
        if($name === "Riasec"){
            $name = 'IRMR';
        }
        if($name === "Positioning Skills"){
            $name = 'savORIENT';
        }
        $controller = 'App\Controller\Tests\\'.$name.'Controller';

        if(class_exists($controller)){
            return $this->forward($controller.'::test'.$name);
        }else{

            throw $this->createNotFoundException("Ce test n'existe pas! Ne modifier l'URL dans la barre d'adresse !");
        }
    }
}
