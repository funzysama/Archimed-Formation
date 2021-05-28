<?php

namespace App\Controller;

use App\Repository\I3PResultatRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;

class AjaxController extends AbstractController
{
    /**
     * @Route("/ajax", name="ajax")
     */
    public function index(Request $request, I3PResultatRepository $resultatRepository, SerializerInterface $serializer): Response
    {
        $id = $request->get('id');
        $resultat = $resultatRepository->find($id);
        $profil = $resultat->getProfil();

        $jsonResultat = $serializer->serialize($resultat, 'json', ['groups' => 'resultat_formated']);
        $jsonProfil = $serializer->serialize($profil, 'json', ['groups' => 'profil_formated']);

        $jsonData1 = json_decode($jsonResultat);
        $jsonData2 = json_decode($jsonProfil);

        $jsonData = (object) array_merge((array) $jsonData1, (array) $jsonData2);

        $json = json_encode($jsonData);

        $response = JsonResponse::fromJsonString($json);
        //$resultatArrayForPdf = $dataFormatter->convertI3PResultat($resultat, $profil);
        //dump($resultatArrayForPdf);
        return $response;
    }
}
