<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PlanetsController extends BaseController
{
    #[Route('/planets', name: 'app_planets')]
    public function index(Request $request): Response
    {
        return $this->renderIndex($request, 'planets/index.html.twig', 'planets');
    }
}
