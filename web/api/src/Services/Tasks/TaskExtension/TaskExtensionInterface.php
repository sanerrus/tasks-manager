<?php

namespace App\Services\Tasks\TaskExtension;

use App\Kernel;

interface TaskExtensionInterface
{
    public function __construct(Kernel $kernel);
}
