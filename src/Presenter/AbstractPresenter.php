<?php

namespace App\Presenter;

use App\Presenter\Contracts\FormatterInterface;
use App\Presenter\Contracts\PresenterInterface;
use App\Presenter\Factory\FormatterFactoryInterface;
use App\Presenter\Translator\TranslationServiceInterface;

abstract class AbstractPresenter implements PresenterInterface
{
    protected FormatterInterface $formatter;

    public function __construct(
        protected TranslationServiceInterface $translator,
        FormatterFactoryInterface $formatterFactory
    )
    {
        $this->formatter = $this->resolveFormatter($formatterFactory);
    }

    abstract protected function getTranslationDomains(): array;

    abstract protected function getEntity(): string;

    private function resolveFormatter(FormatterFactoryInterface $factory): FormatterInterface
    {
        return $factory->getFormatter($this->getEntity());
    }

    public function present(array $datas): array
    {
        $result = [];

        foreach ($datas as $data) {
            $name = $this->translator->translate($data['name'], $this->getTranslationDomains());
            unset($data['name']);

            $translatedData = [];

            foreach ($data as $field => $value) {
                $translatedKey = $this->translator->translate($field, $this->getTranslationDomains());
                $translatedValue = $this->formatter->format($field, $value);

                $translatedData[$translatedKey] = $translatedValue;
            }

            $result[$name] = $translatedData;
        }

        return $result;
    }
}
