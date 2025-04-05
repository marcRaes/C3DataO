<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class VehiclesController extends BaseController
{
    #[Route('/vehicles', name: 'app_vehicles')]
    public function index(Request $request): Response
    {
        return $this->renderIndex($request, 'vehicles/index.html.twig', 'vehicles');
    }
}
