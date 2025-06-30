<?php

namespace App\Presenter;

class PlanetsPresenter extends AbstractPresenter
{
    protected function getTranslationDomains(): array
    {
        return ['messages', 'planets'];
    }

    public function supports(string $entity): bool
    {
        return $entity === 'planets';
    }

    protected function getEntity(): string
    {
        return 'planets';
    }
}
