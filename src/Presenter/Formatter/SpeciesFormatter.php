<?php

namespace App\Presenter\Formatter;

class SpeciesFormatter extends BaseTransportFormatter
{
    protected function getDomain(): string
    {
        return 'species';
    }

    protected function extraFormat(string $field, mixed $value): ?string
    {
        if ($field === 'average_lifespan' && is_numeric($value)) {
            return $value . ' ans';
        }

        return null;
    }
}
