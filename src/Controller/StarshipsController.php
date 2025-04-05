<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class StarshipsController extends BaseController
{
    #[Route('/starships', name: 'app_starships')]
    public function index(Request $request): Response
    {
        return $this->renderIndex($request, 'starships/index.html.twig', 'starships');
    }
}
