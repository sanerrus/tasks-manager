<?php

use App\Kernel;
use Doctrine\ORM\Tools\Console\ConsoleRunner;

$kernel = Kernel::getInstance();
$kernel->run();

$entityManager = $kernel->getEntityManager();

return ConsoleRunner::createHelperSet($entityManager);
