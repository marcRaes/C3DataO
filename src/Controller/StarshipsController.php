<?php

namespace App\Controller;

use App\Service\StarWarsApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class StarshipsController extends AbstractController
{
    public function __construct(
        private readonly StarWarsApiService $starWarsApiService
    ) {}

    #[Route('/starships', name: 'app_starships')]
    public function index(Request $request): Response
    {
        $page = $request->query->get('page') ?? 1;
        $listOfStarships = $this->starWarsApiService->getStarships($page);

        return $this->render('starships/index.html.twig', [
            'listOfStarships' => $listOfStarships['results'],
            'page' => $page,
            'nbPages' => ceil($listOfStarships['count'] / 10),
        ]);
    }
}
