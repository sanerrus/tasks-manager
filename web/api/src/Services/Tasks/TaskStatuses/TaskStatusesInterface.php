<?php

namespace App\Services\Tasks\TaskStatuses;

use App\Kernel;

interface TaskStatusesInterface
{
    public function __construct(Kernel $kernel);
}
