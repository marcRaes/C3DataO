<?php

namespace App\Controller;

use App\Service\StarWarsApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SpeciesController extends AbstractController
{
    public function __construct(
        private readonly StarWarsApiService $starWarsApiService
    ) {}

    #[Route('/species', name: 'app_species')]
    public function index(Request $request): Response
    {
        $page = $request->query->get('page') ?? 1;
        $listOfSpecies = $this->starWarsApiService->getSpecies($page);

        return $this->render('species/index.html.twig', [
            'listOfSpecies' => $listOfSpecies['results'],
            'page' => $page,
            'nbPages' => ceil($listOfSpecies['count'] / 10),
        ]);
    }
}
