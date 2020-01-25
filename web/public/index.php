<?php

declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use App\Kernel;

$kernel = new Kernel();
$kernel->run();
//var_dump($kernel->getContainer()->get('appConfig'));

//phpinfo();
