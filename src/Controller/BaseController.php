<?php

namespace App\Controller;

use App\Api\EndpointRegistry;
use App\Presenter\Factory\PresenterFactoryInterface;
use App\Service\StarWarsApiClient;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Contracts\HttpClient\Exception\TransportExceptionInterface;

abstract class BaseController extends AbstractController
{
    public function __construct(
        protected readonly StarWarsApiClient $starWarsApiClient,
        private readonly PresenterFactoryInterface $presenterFactory,
        private readonly EndpointRegistry $endpointRegistry
    ) {}

    /**
     * @throws TransportExceptionInterface
     */
    protected function renderIndex(Request $request, string $template, string $entityType): Response
    {
        $endpoint = $this->endpointRegistry->get($entityType);
        $entities = $this->starWarsApiClient->fetch($endpoint);

        $perPage = 9;
        $currentPage = max(1, (int)$request->query->get('page', 1));
        $totalPages = (int) ceil(count($entities) / $perPage);
        $sliced = array_slice($entities, ($currentPage - 1) * $perPage, $perPage);
        $presenter = $this->presenterFactory->getPresenter($entityType);

        return $this->render($template, [
            'listOf' . ucfirst($entityType) => $presenter->present($sliced),
            'currentPage' => $currentPage,
            'totalPages' => $totalPages,
        ]);
    }
}
