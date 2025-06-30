<?php

namespace App\Api;

class EndpointRegistry
{
    /** @var ApiEndpointInterface[] */
    private array $endpoints = [];

    public function __construct(iterable $endpoints)
    {
        foreach ($endpoints as $endpoint) {
            $this->endpoints[$endpoint->getEntityType()] = $endpoint;
        }
    }

    public function get(string $entity): ApiEndpointInterface
    {
        if (!isset($this->endpoints[$entity])) {
            throw new \InvalidArgumentException("Unknown entity type: $entity");
        }

        return $this->endpoints[$entity];
    }
}
