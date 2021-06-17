<?php

namespace App\Controller;

use App\Entity\Utilisateur;
use App\Repository\I3PResultatRepository;
use App\Repository\UtilisateurRepository;
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
     * @param Request $request
     * @param I3PResultatRepository $resultatRepository
     * @param SerializerInterface $serializer
     * @return Response
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
        return $response;
    }

}
