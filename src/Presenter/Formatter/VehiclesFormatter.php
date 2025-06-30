<?php

namespace App\Presenter\Formatter;

class VehiclesFormatter extends BaseTransportFormatter
{
    protected function getDomain(): string
    {
        return 'vehicles';
    }
}
