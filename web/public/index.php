<?php

declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use App\Kernel;

$kernel = Kernel::getInstance();
$kernel->run();
//var_dump($kernel->getContainer()->get('appConfig'));

//phpinfo();
