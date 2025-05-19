<?php

namespace Q01SDK\Auth;

use Q01SDK\Http\Client;

/**
 * ArtCollectionController class
 * 
 * This controller handles arts operations such as fetching arts information
 */
class ArtCollectionController
{
    private AuthService $authService;
    private Client $client;

    /**
     * Constructor method
     *
     * Initializes the ArtCollectionController with AuthService and creates a new HTTP client instance.
     *
     * @param AuthService $authService The authentication service to handle authorization.
     */
    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
        $this->client = new Client();
    }



    /**
     * Recupera una singola pagina da Q01.
     * Effettua una richiesta all'API di Q01 per ottenere gli elementi paginati.
     *
     * @param int $pageSize Il numero di elementi da recuperare in una singola pagina. Valore predefinito: 10.
     * @param int $page Il numero della pagina da recuperare. Valore predefinito: 0 (prima pagina).
     * @return array|null Ritorna un array contenente i dispositivi della pagina corrente e i metadati della risposta
     *                    (come `totalPages`, `hasNext`, ecc.). Ritorna `null` in caso di errore.
     */

    public function getAll(string $uri, int $pageSize = 10, int $page = 0): ?array
    {
        // Makes an HTTP GET request to fetch all devices information.
        $response = $this->client->request(
            $this->authService->getBaseUrl(),
            'GET',
            $uri,
            [
                'headers' => ['X-Authorization' => 'Bearer ' . $this->authService->getToken()],
                'query' => [
                    'pageSize' => $pageSize,
                    'page' => $page,
                ],
            ]
        );

        // Returns the JSON response as an associative array, or null if the request failed.
        return $response ? $response->getJson() : null;
    }




    // Other controller methods can be added here
}
