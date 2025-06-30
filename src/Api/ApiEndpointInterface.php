<?php

namespace App\Api;

interface ApiEndpointInterface
{
    public function getEndpoint(): string;

    public function getEntityType(): string;

    public function process(array $data): array;
}
