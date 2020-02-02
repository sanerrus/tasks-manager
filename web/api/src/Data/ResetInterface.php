<?php

namespace App\Data;

interface ResetInterface
{
    /**
     * Сброс всех данных объекта.
     */
    public function reset(): self;
}
