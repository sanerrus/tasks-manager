<?php

namespace App\Services;

use App\Data\ResponseSearchForm;

interface ServiceInterface
{
    public function getResponseSearchForm(): ResponseSearchForm;
}
