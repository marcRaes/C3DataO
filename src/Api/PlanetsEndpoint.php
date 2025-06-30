<?php

namespace App\Api;

class PlanetsEndpoint extends BaseApiEndpoint
{
    public function getEndpoint(): string
    {
        return 'planets';
    }

    public function getEntityType(): string
    {
        return 'planets';
    }

    protected function getFieldsToExclude(): array
    {
        return [
            'residents', 'films'
        ];
    }
}
