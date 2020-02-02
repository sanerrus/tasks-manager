<?php

namespace App\Data;

interface DataInterface
{
    /**
     * Преобразуем данные объекта в итерируемые данные.
     */
    public function toIterable(): iterable;
}
