<?php

namespace App\Api;

class FilmsEndpoint extends BaseApiEndpoint
{
    public function getEndpoint(): string
    {
        return 'films';
    }

    public function getEntityType(): string
    {
        return 'films';
    }

    public function process(array $data): array
    {
        $films = array_map(fn ($entry) => $this->cleanEntry($entry), $data);

        usort($films, function($a, $b) {
            return $a['episode_id'] <=> $b['episode_id'];
        });

        return $films;
    }

    protected function getFieldsToExclude(): array
    {
        return [
            'characters', 'planets', 'vehicles', 'starships', 'species'
        ];
    }
}
