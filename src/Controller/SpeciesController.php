<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class SpeciesController extends BaseController
{
    #[Route('/species', name: 'app_species')]
    public function index(Request $request): Response
    {
        return $this->renderIndex($request, 'species/index.html.twig', 'species');
    }
}
