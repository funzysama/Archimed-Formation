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
                'client_id' => 'PAR_archimed_bd9bc407b3e14c40ef357a29786a756bc5b860fb664e65760e56aa7ca56a36dc',
                'client_secret' => '82e179f065200abed7d7477dd285dc2c73e6ae098b567b07a5f2e26f6f47624b',
                'scope' => 'api_romev1 application_PAR_archimed_bd9bc407b3e14c40ef357a29786a756bc5b860fb664e65760e56aa7ca56a36dc nomenclatureRome'
            ],
            'headers' => [
                'Accept' => 'application/json',
                'Content-type' => 'application/x-www-form-urlencoded'
            ]
        ]);
        return $result->toArray()['access_token'];
    }

    public function getAllMetiers($token)
    {
        $url = "https://api.emploi-store.fr/partenaire/rome/v1/metier";
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
        $metiersFormatted = [];
        foreach ($result as $metier) {
            array_push($metiersFormatted, $this->searchByKey($keyAllowed, $metier));
        }
        return json_encode($metiersFormatted);
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
}