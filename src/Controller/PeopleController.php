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

final class PeopleController extends AbstractController
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
    #[Route('/people', name: 'app_people')]
    public function index(Request $request): Response
    {
        $page = $request->query->get('page') ?? 1;
        $listOfCharacters = $this->starWarsApiService->getCharacters($page);

        return $this->render('people/index.html.twig', [
            'listOfCharacters' => $listOfCharacters['results'],
            'page' => $page,
            'nbPages' => ceil($listOfCharacters['count'] / 10),
        ]);
    }
}
