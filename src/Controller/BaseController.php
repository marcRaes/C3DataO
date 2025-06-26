<?php

namespace App\Controller;

use App\Service\StarWarsApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

abstract class BaseController extends AbstractController
{
    public function __construct(
        private readonly StarWarsApiService $starWarsApiService
    ) {}

    protected function renderIndex(Request $request, string $template, string $entityType): Response
    {
        $page = $request->query->get('page') ?? 1;
        $method = 'get' . ucfirst($entityType);
        $listOfEntities = $this->starWarsApiService->$method($page);

        return $this->render($template, [
            'listOf' . ucfirst($entityType) => $listOfEntities,
            'page' => $page,
            'nbPages' => count($listOfEntities) / 10,
        ]);
    }
}