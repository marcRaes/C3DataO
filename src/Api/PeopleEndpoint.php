<?php

namespace App\Api;

class PeopleEndpoint extends BaseApiEndpoint
{
    public function getEndpoint(): string
    {
        return 'people';
    }

    public function getEntityType(): string
    {
        return 'people';
    }

    protected function getFieldsToExclude(): array
    {
        return [
            'species', 'films', 'vehicles', 'starships'
        ];
    }
}
