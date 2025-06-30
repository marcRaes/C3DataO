<?php

namespace App\Presenter\Factory;

use App\Presenter\Contracts\PresenterInterface;

interface PresenterFactoryInterface
{
    public function getPresenter(string $entity): PresenterInterface;
}
