<?php

namespace App\Presenter\Contracts;

interface FormatterInterface
{
    public function format(string $field, mixed $value): string;
}
