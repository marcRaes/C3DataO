<?php

declare(strict_types=1);

namespace App\Service;

use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;
use Symfony\Contracts\HttpClient\HttpClientInterface;

class StarWarsApiService
{
    private const BASE_URL = 'https://swapi.dev/api/';
    private const BASE_URL_PEOPLE = self::BASE_URL . 'people';
    private const BASE_URL_FILMS = self::BASE_URL . 'films';
    private const BASE_URL_PLANETS = self::BASE_URL . 'planets';
    private const BASE_URL_SPECIES = self::BASE_URL . 'species';
    private const BASE_URL_STARSHIPS = self::BASE_URL . 'starships';
    private const BASE_URL_VEHICLES = self::BASE_URL . 'vehicles';

    public function __construct(
        private readonly HttpClientInterface $httpClient
    ) {}

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function getCharacters(int $page = 1): array
    {
        $response = $this->httpClient->request('GET', self::BASE_URL_PEOPLE . '?page=' . $page);

        return $this->removeUnnecessaryFields($response->toArray());
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function getFilms(): array
    {
        $response = $this->httpClient->request('GET', self::BASE_URL_FILMS);

        return $this->removeUnnecessaryFields($response->toArray());
    }

    public function getPlanets(int $page = 1): array
    {
        $response = $this->httpClient->request('GET', self::BASE_URL_PLANETS . '?page=' . $page);

        return $this->removeUnnecessaryFields($response->toArray());
    }

    public function getSpecies(int $page = 1): array
    {
        $response = $this->httpClient->request('GET', self::BASE_URL_SPECIES . '?page=' . $page);

        return $this->removeUnnecessaryFields($response->toArray());
    }

    public function getStarships(int $page = 1): array
    {
        $response = $this->httpClient->request('GET', self::BASE_URL_STARSHIPS . '?page=' . $page);

        return $this->removeUnnecessaryFields($response->toArray());
    }

    public function getVehicles(int $page = 1): array
    {
        $response = $this->httpClient->request('GET', self::BASE_URL_VEHICLES . '?page=' . $page);

        return $this->removeUnnecessaryFields($response->toArray());
    }

    private function removeUnnecessaryFields(array $entities): array
    {
        foreach($entities['results'] as $key => $character) {
            unset($entities['results'][$key]['homeworld']);
            unset($entities['results'][$key]['films']);
            unset($entities['results'][$key]['characters']);
            unset($entities['results'][$key]['residents']);
            unset($entities['results'][$key]['people']);
            unset($entities['results'][$key]['pilots']);
            unset($entities['results'][$key]['planets']);
            unset($entities['results'][$key]['species']);
            unset($entities['results'][$key]['vehicles']);
            unset($entities['results'][$key]['starships']);
            unset($entities['results'][$key]['created']);
            unset($entities['results'][$key]['edited']);
            unset($entities['results'][$key]['url']);
        }

        return $entities;
    }
}
