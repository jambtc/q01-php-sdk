<?php

namespace Q01SDK\Auth;

use Q01SDK\Http\Client;
use GuzzleHttp\Exception\RequestException;

class AuthService
{
    private Client $client;
    private string $baseUrl;
    private ?string $token = null;

    public function __construct(string $baseUrl)
    {
        $this->client = new Client();
        $this->baseUrl = rtrim($baseUrl, '/');
    }

    public function validateToken(): ?bool
    {
        try {
            $response = $this->client->request(
                $this->baseUrl,
                'GET',
                '/api/v4/auth/tokenvalidator',
                [
                    'headers' => [
                        'Authorization' => 'Bearer ' . $this->token
                    ],
                    'timeout' => 5,
                    'http_errors' => false
                ]
            );

            return $response->getStatusCode() === 200;
        } catch (RequestException $e) {
            throw new \Exception("Errore durante la validazione del token: " . $e->getMessage());
        }
    }

    /**
     * Verifica se il token è valido
     * 
     * @return bool
     */
    public function isAuthenticated(): bool
    {
        return !empty($this->token) && $this->validateToken();
    }

    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function getClient(): Client
    {
        return $this->client;
    }

    public function getBaseUrl(): string
    {
        return $this->baseUrl;
    }
}
