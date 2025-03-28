<?php

namespace App\Controller;

use App\Service\StarWarsApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PlanetsController extends AbstractController
{
    public function __construct(
        private readonly StarWarsApiService $starWarsApiService
    ) {}

    #[Route('/planets', name: 'app_planets')]
    public function index(Request $request): Response
    {
        $page = $request->query->get('page') ?? 1;
        $listOfPlanets = $this->starWarsApiService->getPlanets($page);

        return $this->render('planets/index.html.twig', [
            'listOfPlanets' => $listOfPlanets['results'],
            'page' => $page,
            'nbPages' => ceil($listOfPlanets['count'] / 10),
        ]);
    }
}
