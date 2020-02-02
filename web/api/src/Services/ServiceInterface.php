<?php

namespace App\Services;

use App\Data\ResponseSearchForm;

interface ServiceInterface
{
    /**
     * Возвращаем данные для формы поиска задач.
     */
    public function getResponseSearchForm(): ResponseSearchForm;
}
