<?php

namespace App\Api;

class StarshipsEndpoint extends BaseApiEndpoint
{
    public function getEndpoint(): string
    {
        return 'starships';
    }

    public function getEntityType(): string
    {
        return 'starships';
    }

    protected function getFieldsToExclude(): array
    {
        return [
            'pilots', 'films'
        ];
    }
}
