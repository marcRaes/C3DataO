<?php

namespace App\Presenter\Translator;

use Symfony\Contracts\Translation\TranslatorInterface;
use Symfony\Component\Translation\TranslatorBagInterface;

readonly class TranslationService implements TranslationServiceInterface
{
    public function __construct(
        private TranslatorInterface $translator,
        private TranslatorBagInterface $bag,
        private string $locale = 'fr'
    ) {
        if (!$translator instanceof TranslatorBagInterface) {
            throw new \LogicException('Translator must implement TranslatorBagInterface.');
        }
    }

    public function translate(string $key, array $domains, string $locale = null): string
    {
        $locale = $locale ?? $this->locale;

        foreach ($domains as $domain) {
            if ($this->bag->getCatalogue($locale)->has($key, $domain)) {
                return $this->translator->trans($key, [], $domain, $locale);
            }
        }

        return $key;
    }
}
