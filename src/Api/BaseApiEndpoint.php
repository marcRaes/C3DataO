<?php

namespace App\Api;

abstract class BaseApiEndpoint implements ApiEndpointInterface
{
    protected const COMMON_FIELDS_TO_EXCLUDE = ['created', 'edited', 'url', 'homeworld'];

    abstract protected function getFieldsToExclude(): array;

    public function process(array $data): array
    {
        return array_map(fn($entry) => $this->cleanEntry($entry), $data);
    }

    protected function cleanEntry(array $entry): array
    {
        $fieldsToExclude = array_merge($this->getFieldsToExclude(), static::COMMON_FIELDS_TO_EXCLUDE);

        foreach ($fieldsToExclude as $field) {
            unset($entry[$field]);
        }

        return $entry;
    }
}
