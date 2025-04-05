<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class FilmsController extends BaseController
{
    #[Route('/films', name: 'app_films')]
    public function index(Request $request): Response
    {
        return $this->renderIndex($request, 'films/index.html.twig', 'films');
    }
}
