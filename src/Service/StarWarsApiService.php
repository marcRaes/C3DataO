<?php

declare(strict_types=1);

namespace App\Service;

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

    public function getCharacters(int $page = 1): array
    {
        $response = $this->httpClient->request('GET', self::BASE_URL_PEOPLE . '?page=' . $page);

        return $response->toArray();
    }

    public function getFilms(): array
    {
        $response = $this->httpClient->request('GET', self::BASE_URL_FILMS);

        return $response->toArray();
    }

    public function getPlanets(int $page = 1): array
    {
        $response = $this->httpClient->request('GET', self::BASE_URL_PLANETS . '?page=' . $page);

        return $response->toArray();
    }

    public function getSpecies(int $page = 1): array
    {
        $response = $this->httpClient->request('GET', self::BASE_URL_SPECIES . '?page=' . $page);

        return $response->toArray();
    }

    public function getStarships(int $page = 1): array
    {
        $response = $this->httpClient->request('GET', self::BASE_URL_STARSHIPS . '?page=' . $page);

        return $response->toArray();
    }

    public function getVehicles(int $page = 1): array
    {
        $response = $this->httpClient->request('GET', self::BASE_URL_VEHICLES . '?page=' . $page);

        return $response->toArray();
    }
}
