<?php

namespace App\Presenter\Formatter;

use App\Presenter\Contracts\FormatterInterface;
use App\Presenter\Translator\TranslationServiceInterface;

readonly class PlanetsFormatter implements FormatterInterface
{
    public function __construct(private TranslationServiceInterface $translator) {}

    public function format(string $field, mixed $value): string
    {
        $translated = $this->translator->translate($value, ['messages', 'planets']);

        if ($field === 'rotation_period' && is_numeric($value)) {
            return $translated . ' heures';
        }

        if ($field === 'orbital_period' && is_numeric($value)) {
            return $translated . ' jours';
        }

        if ($field === 'diameter' && is_numeric($value)) {
            return $translated . ' km';
        }

        if ($field === 'surface_water' && is_numeric($value)) {
            return $translated . ' %';
        }

        return $translated;
    }
}
