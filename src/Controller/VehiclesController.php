<?php

namespace App\Controller;

use App\Service\StarWarsApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class VehiclesController extends AbstractController
{
    public function __construct(
        private readonly StarWarsApiService $starWarsApiService
    ) {}

    #[Route('/vehicles', name: 'app_vehicles')]
    public function index(Request $request): Response
    {
        $page = $request->query->get('page') ?? 1;
        $listOfVehicles = $this->starWarsApiService->getVehicles($page);

        return $this->render('vehicles/index.html.twig', [
            'listOfVehicles' => $listOfVehicles['results'],
            'page' => $page,
            'nbPages' => ceil($listOfVehicles['count'] / 10),
        ]);
    }
}
