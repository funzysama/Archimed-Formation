<?php

namespace App\Controller;

use App\Repository\MetierPERepository;
use App\Service\ApiCallsService;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request as ApiRequest;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class PoleEmploiController extends AbstractController
{
    /**
     * @Route("/pole-emploi", name="api_pole_emploi")
     */
    public function apiPoleEmploi(MetierPERepository $repository, Request $request, ApiCallsService $client): Response
    {
        $riasecMaj = $request->get("riasecMajeur");
        $riasecMin = $request->get("riasecMineur");

        $token = $client->getBearerToken();
        $metier = $client->getAllMetiers($token);

        if($riasecMaj != null || $riasecMin != null){
            $metiers = $repository->findByRiasec($riasecMaj, $riasecMin);
        }
        return $this->render('main/api-pole-emploi.html.twig', [
            'metiers' => $metier,
        ]);
    }
}
