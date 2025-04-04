<?php

namespace App\Controller;

use App\Service\StarWarsApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\HttpClient\Exception\ClientExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\DecodingExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\RedirectionExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\ServerExceptionInterface;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

final class FilmsController extends AbstractController
{
    public function __construct(
        private readonly StarWarsApiService $starWarsApiService
    ) {}

    /**
     * @throws TransportExceptionInterface
     * @throws ServerExceptionInterface
     * @throws RedirectionExceptionInterface
     * @throws DecodingExceptionInterface
     * @throws ClientExceptionInterface
     */
    #[Route('/films', name: 'app_films')]
    public function index(Request $request): Response
    {
        $page = $request->query->get('page') ?? 1;
        $listOfFilms = $this->starWarsApiService->getFilms();

        usort($listOfFilms['results'], function($a, $b) {
            return $a['episode_id'] <=> $b['episode_id'];
        });

        return $this->render('films/index.html.twig', [
            'listOfFilms' => $listOfFilms['results'],
            'page' => $page,
            'nbPages' => ceil($listOfFilms['count'] / 10),
        ]);
    }
}
