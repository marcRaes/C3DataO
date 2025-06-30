<?php

namespace App\Presenter\Formatter;

use App\Presenter\Contracts\FormatterInterface;
use App\Presenter\Translator\TranslationServiceInterface;

readonly class FilmsFormatter implements FormatterInterface
{
    public function __construct(private TranslationServiceInterface $translator) {}

    public function format(string $field, mixed $value): string
    {
        if ($field === 'opening_crawl') {
            $value = str_replace(["\r\n", "\n", "\r"], ' ', $value);
        }

        if ($field === 'release_date') {
            $date = \DateTime::createFromFormat('Y-m-d', $value);
            return $date ? $date->format('d-m-Y') : $value;
        }

        return $this->translator->translate($value, ['messages', 'films']);
    }
}
