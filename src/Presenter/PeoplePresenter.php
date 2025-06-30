<?php

namespace App\Presenter;

class PeoplePresenter extends AbstractPresenter
{
    protected function getTranslationDomains(): array
    {
        return ['messages', 'people'];
    }

    public function supports(string $entity): bool
    {
        return $entity === 'people';
    }

    protected function getEntity(): string
    {
        return 'people';
    }
}