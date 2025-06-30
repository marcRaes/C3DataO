<?php

namespace App\Presenter;

class SpeciesPresenter extends AbstractPresenter
{
    protected function getTranslationDomains(): array
    {
        return ['messages', 'species'];
    }

    public function supports(string $entity): bool
    {
        return $entity === 'species';
    }

    protected function getEntity(): string
    {
        return 'species';
    }
}
