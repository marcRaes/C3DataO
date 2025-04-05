<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class PeopleController extends BaseController
{
    #[Route('/people', name: 'app_people')]
    public function index(Request $request): Response
    {
        return $this->renderIndex($request, 'people/index.html.twig', 'people');
    }
}
