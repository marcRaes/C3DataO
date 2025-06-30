<?php

namespace App\Presenter\Formatter;

use App\Presenter\Contracts\FormatterInterface;
use App\Presenter\Translator\TranslationServiceInterface;

abstract class BaseTransportFormatter implements FormatterInterface
{
    public function __construct(protected TranslationServiceInterface $translator) {}

    abstract protected function getDomain(): string;

    protected function extraFormat(string $field, mixed $value): ?string
    {
        return null;
    }

    public function format(string $field, mixed $value): string
    {
        // Cas personnalisé
        if ($custom = $this->extraFormat($field, $value)) {
            return $custom;
        }

        if (in_array($field, ['height', 'average_height'])) {
            return $value . ' cm';
        }

        if ($field === 'cost_in_credits' && is_numeric($value)) {
            return $value . ' crédits';
        }

        if ($field === 'length' && (is_numeric($value) || is_float($value))) {
            return $value . ' m';
        }

        if ($field === 'max_atmosphering_speed' && is_numeric($value)) {
            return $value . ' km/h';
        }

        if (in_array($field, ['crew', 'passengers']) && is_numeric($value)) {
            return $value . ' personnes';
        }

        if ($field === 'cargo_capacity' && is_numeric($value)) {
            return $value . ' kg';
        }

        return $this->translator->translate($value, ['messages', $this->getDomain()]);
    }
}
