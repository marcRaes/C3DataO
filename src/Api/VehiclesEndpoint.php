<?php

namespace App\Api;

class VehiclesEndpoint extends BaseApiEndpoint
{
    public function getEndpoint(): string
    {
        return 'vehicles';
    }

    public function getEntityType(): string
    {
        return 'vehicles';
    }

    protected function getFieldsToExclude(): array
    {
        return [
            'pilots', 'films'
        ];
    }
}
