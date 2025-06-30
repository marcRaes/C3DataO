<?php

namespace App\Presenter;

class VehiclesPresenter extends AbstractPresenter
{
    protected function getTranslationDomains(): array
    {
        return ['messages', 'vehicles'];
    }

    public function supports(string $entity): bool
    {
        return $entity === 'vehicles';
    }

    protected function getEntity(): string
    {
        return 'vehicles';
    }
}
