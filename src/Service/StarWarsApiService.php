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
    private const BASE_URL_PEOPLE = 'people';
    private const BASE_URL_FILMS = 'films';
    private const BASE_URL_PLANETS = 'planets';
    private const BASE_URL_SPECIES = 'species';
    private const BASE_URL_STARSHIPS = 'starships';
    private const BASE_URL_VEHICLES = 'vehicles';

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
    public function getEntities(string $endpoint, int $page = 1): array
    {
        $response = $this->httpClient->request('GET', self::BASE_URL . $endpoint . '?page=' . $page);

        return $this->removeUnnecessaryFields($response->toArray());
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function getPeople(int $page = 1): array
    {
        return $this->getEntities(self::BASE_URL_PEOPLE, $page);
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function getFilms(int $page = 1): array
    {
        $films = $this->getEntities(self::BASE_URL_FILMS, $page);

        usort($films['results'], function($a, $b) {
            return $a['episode_id'] <=> $b['episode_id'];
        });

        return $films;
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function getPlanets(int $page = 1): array
    {
        return $this->getEntities(self::BASE_URL_PLANETS, $page);
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function getSpecies(int $page = 1): array
    {
        return $this->getEntities(self::BASE_URL_SPECIES, $page);
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function getStarships(int $page = 1): array
    {
        return $this->getEntities(self::BASE_URL_STARSHIPS, $page);
    }

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    public function getVehicles(int $page = 1): array
    {
        return $this->getEntities(self::BASE_URL_VEHICLES, $page);
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
