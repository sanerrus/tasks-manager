<?php

namespace App\Services\Tasks;

use App\Kernel;

interface TasksInterface
{
    public function __construct(Kernel $kernel);
}
