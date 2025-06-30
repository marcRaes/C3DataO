<?php

namespace App\Presenter;

class StarshipsPresenter extends AbstractPresenter
{
    protected function getTranslationDomains(): array
    {
        return ['messages', 'starships'];
    }

    public function supports(string $entity): bool
    {
        return $entity === 'starships';
    }

    protected function getEntity(): string
    {
        return 'starships';
    }
}
