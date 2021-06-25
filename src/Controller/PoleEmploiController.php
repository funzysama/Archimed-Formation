<?php

namespace App\Controller;

use App\Service\ApiCallsService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PoleEmploiController extends AbstractController
{
    private const URL_METIER = 'https://api.emploi-store.fr/partenaire/rome/v1/metier';
    private const URL_COMPETENCE = 'https://api.emploi-store.fr/partenaire/rome/v1/competence';

    /**
     * @Route("/pole-emploi-index", name="index_pole_emploi")
     */
    public function indexPoleEmploi(): Response
    {
        return $this->render('pole_emploi/index.html.twig');
    }

    /**
     * @Route("/pole-emploi/ROME", name="api_pole_emploi")
     * @param Request $request
     * @param ApiCallsService $client
     * @return Response
     */
    public function apiPoleEmploiROME(Request $request, ApiCallsService $client): Response
    {
        $riasecMaj = $request->get("riasecMajeur");
        $riasecMin = $request->get("riasecMineur");
        $type = $request->get("type");
        dump($request);
        if($type == "competence"){
            $url = "https://api.emploi-store.fr/partenaire/rome/v1/".$type."?riasecmajeur=".$riasecMaj."&riasecmineur=".$riasecMin;
        }else{
            $url = "https://api.emploi-store.fr/partenaire/rome/v1/".$type;
        }
        $token = $client->getBearerToken();
        $data = $client->getAllData($token, $url);

        //call pour recuperer les metier en BMO
        //$metierBMO = $client->getAllMetiersBMO($token);
        //faire un appel sur le référenciel FAP2009 pour matcher le ROME/BMO
        //ajouter le code BMO dans l'array des donné envoyer au tableau pour le traiter sous form de lien vers le site

        return $this->render('pole_emploi/api-pole-emploi.html.twig', [
            'data'          => $data,
            'type'          => $type,
            'riasecMajeur'  => $riasecMaj,
            'riasecMineur'  => $riasecMin
        ]);
    }

    /**
     * @Route("/pole-emploi/SoftSkills", name="soft_skills_pole_emploi")
     * @param Request $request
     * @param ApiCallsService $client
     * @return Response
     */
    public function apiPoleEmploiSoftSkills(Request $request, ApiCallsService $client): Response
    {
        $code = $request->get('code');
        $titre = $request->get('titre');
        $url = 'https://api.emploi-store.fr/partenaire/matchviasoftskills/v1/professions/job_skills?code='.$code;
        $token = $client->getBearerToken();
        $data = $client->postAllData($token, $url);
        return $this->render('pole_emploi/soft-skills-pole-emploi.html.twig', [
            'titreMetier'   => $titre,
            'data'          => json_encode(array_values($data["skills"])),
        ]);
//        return $this->json(json_decode($data));
    }

}
