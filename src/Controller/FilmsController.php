<?php

namespace App\Controller;

use App\Service\StarWarsApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FilmsController extends AbstractController
{
    public function __construct(
        private readonly StarWarsApiService $starWarsApiService
    ) {}

    #[Route('/films', name: 'app_films')]
    public function index(): Response
    {
        $listOfFilms = $this->starWarsApiService->getFilms();

        return $this->render('films/index.html.twig', [
            'films' => $listOfFilms['results'],
        ]);
    }
}
