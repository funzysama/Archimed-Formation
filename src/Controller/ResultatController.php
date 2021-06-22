<?php

namespace App\Controller;

use App\Service\I3PCalculator;
use App\Service\pdfDataFormatter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ResultatController extends AbstractController
{
    /**
     * @Route("/resultat/{name}/{id}", name="resultat")
     */
    public function index($name, $id): Response
    {
        if($name === 'IRMR'){
            $repository = $this->getDoctrine()->getRepository('App\Entity\IrmrResultat');
        }else{
            $repository = $this->getDoctrine()->getRepository('App\Entity\\'.$name.'Resultat');
        }

        $resultat = $repository->find($id);
        $controller = 'App\Controller\Tests\\'.$name.'Controller';
        if(class_exists($controller)){
            return $this->forward($controller.'::resultat'.$name, ['resultat' =>$resultat]);
        }else{

            throw $this->createNotFoundException("Ce test n'existe pas! Ne modifier l'URL dans la barre d'adresse !");
        }
    }
}
