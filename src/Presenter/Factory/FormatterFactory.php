<?php

namespace App\Presenter\Factory;

use App\Presenter\Contracts\FormatterInterface;

class FormatterFactory implements FormatterFactoryInterface
{
    /**
     * @var FormatterInterface[]
     */
    private array $formatters = [];

    public function __construct(iterable $formatters)
    {
        foreach ($formatters as $formatter) {
            $entity = $this->guessEntityTypeFromClass($formatter);
            $this->formatters[$entity] = $formatter;
        }
    }

    public function getFormatter(string $entityType): FormatterInterface
    {
        if (!isset($this->formatters[$entityType])) {
            throw new \InvalidArgumentException("No formatter found for entity type '$entityType'.");
        }

        return $this->formatters[$entityType];
    }

    private function guessEntityTypeFromClass(FormatterInterface $formatter): string
    {
        $class = (new \ReflectionClass($formatter))->getShortName();

        return strtolower(str_replace('Formatter', '', $class));
    }
}
