<?php

namespace App\Service;

use App\Api\ApiEndpointInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

class StarWarsApiClient
{
    private const BASE_URL = 'https://swapi.info/api/';

    public function __construct(
        private readonly HttpClientInterface $httpClient,
    ) {}

    /**
     * @throws TransportExceptionInterface
     */
    public function fetch(ApiEndpointInterface $endpoint): array
    {
        $response = $this->httpClient->request('GET', self::BASE_URL . $endpoint->getEndpoint());
        $data = $response->toArray();

        return $endpoint->process($data);
    }
}
