<?php

namespace App\Presenter\Formatter;

class StarshipsFormatter extends BaseTransportFormatter
{
    protected function getDomain(): string
    {
        return 'starships';
    }

    protected function extraFormat(string $field, mixed $value): ?string
    {
        if ($field === 'MGLT' && is_numeric($value)) {
            return $value . ' MGLT/h';
        }

        return null;
    }
}
