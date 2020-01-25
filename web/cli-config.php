<?php

use App\Kernel;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

$kernel = new Kernel();
$kernel->run();

$entityManager = $kernel->getEntityManager();

return ConsoleRunner::createHelperSet($entityManager);
