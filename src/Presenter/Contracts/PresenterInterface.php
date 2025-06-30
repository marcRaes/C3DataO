<?php

namespace App\Presenter\Contracts;

interface PresenterInterface
{
    public function present(array $datas): array;
}
