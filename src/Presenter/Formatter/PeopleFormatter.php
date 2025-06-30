<?php

namespace App\Presenter\Formatter;

class PeopleFormatter extends BaseTransportFormatter
{
    protected function getDomain(): string
    {
        return 'people';
    }

    protected function extraFormat(string $field, mixed $value): ?string
    {
        if ($field === 'mass' && is_numeric($value)) {
            return $value . ' kg';
        }

        return null;
    }
}
