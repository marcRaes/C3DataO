<?php

namespace App\Controller;

use App\Service\StarWarsApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PeopleController extends AbstractController
{
    public function __construct(
        private readonly StarWarsApiService $starWarsApiService
    ) {}

    #[Route('/people', name: 'app_people')]
    public function index(Request $request): Response
    {
        $page = $request->query->get('page') ?? 1;
        $listOfCharacters = $this->starWarsApiService->getCharacters($page);

        return $this->render('people/index.html.twig', [
            'characters' => $listOfCharacters['results'],
            'page' => $page,
            'nbPages' => ceil($listOfCharacters['count'] / 10),
        ]);
    }
}
