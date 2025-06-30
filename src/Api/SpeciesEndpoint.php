<?php

namespace App\Api;

class SpeciesEndpoint extends BaseApiEndpoint
{
    public function getEndpoint(): string
    {
        return 'species';
    }

    public function getEntityType(): string
    {
        return 'species';
    }

    protected function getFieldsToExclude(): array
    {
        return [
            'people', 'films'
        ];
    }
}
