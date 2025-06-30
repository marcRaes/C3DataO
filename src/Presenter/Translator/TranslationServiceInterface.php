<?php

namespace App\Presenter\Translator;

interface TranslationServiceInterface
{
    public function translate(string $key, array $domains, string $locale = 'fr'): string;
}
