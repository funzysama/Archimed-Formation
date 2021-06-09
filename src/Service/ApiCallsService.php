<?php


namespace App\Service;


use Symfony\Contracts\HttpClient\HttpClientInterface;

class ApiCallsService
{
    private $client;

    public function __construct(HttpClientInterface $client)
    {
        $this->client = $client;
    }

    public function getBearerToken()
    {
        $url = 'https://entreprise.pole-emploi.fr/connexion/oauth2/access_token?realm=/partenaire';
        $result = $this->client->request('POST', $url, [
            'body' => [
                'grant_type' => 'client_credentials',
                'client_id' => $_SERVER['POLE_EMPLOI_CLIENT_ID'],
                'client_secret' => $_SERVER['POLE_EMPLOI_CLIENT_SECRET'],
                'scope' => $_SERVER['POLE_EMPLOI_SCOPE']
            ],
            'headers' => [
                'Accept' => 'application/json',
                'Content-type' => 'application/x-www-form-urlencoded'
            ]
        ]);
        return $result->toArray()['access_token'];
    }

    public function getAllData($token , $url)
    {
        $response = $this->client->request('GET', $url, [
            'auth_bearer' => $token,
        ]);
        $result = $response->toArray();
        $keyAllowed = [
            "code",
            "libelle",
            "riasecMajeur",
            "riasecMineur"
        ];
        $dataFormatted = [];
        foreach ($result as $data) {
            array_push($dataFormatted, $this->searchByKey($keyAllowed, $data));
        }
        return json_encode($dataFormatted);
    }

    function searchByKey($keyAllowed, $array)
    {
        return array_filter(
            $array,
            function ($key) use ($keyAllowed) {
                return in_array($key, $keyAllowed);
            },
            ARRAY_FILTER_USE_KEY
        );
    }

    public function getAllMetiersBMO($token)
    {
        $url = "https://api.emploi-store.fr/partenaire/infotravail/v1";
        $response = $this->client->request('GET', $url, [
            'auth_bearer' => $token,
        ]);
        $result = $response->toArray();
        dump($result);
        $keyAllowed = [
            "code",
            "libelle",
            "riasecMajeur",
            "riasecMineur"
        ];
        $metiersFormatted = [];
        foreach ($result as $metier) {
            array_push($metiersFormatted, $this->searchByKey($keyAllowed, $metier));
        }
        return json_encode($metiersFormatted);

    }
}