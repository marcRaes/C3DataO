<?php

namespace App\Presenter\Factory;

use App\Presenter\Contracts\FormatterInterface;

interface FormatterFactoryInterface
{
    public function getFormatter(string $entityType): FormatterInterface;
}
