<?php

namespace App\Presenter;

class FilmsPresenter extends AbstractPresenter
{
    public function present(array $datas): array
    {
        $result = [];

        foreach ($datas as $film) {
            $translatedData = [];

            foreach ($film as $field => $value) {
                $translatedData[$field] = $this->formatter->format($field, $value);
            }

            $result[] = $translatedData;
        }

        return $result;
    }

    protected function getTranslationDomains(): array
    {
        return ['messages', 'films'];
    }

    public function supports(string $entity): bool
    {
        return $entity === 'films';
    }

    protected function getEntity(): string
    {
        return 'films';
    }
}
