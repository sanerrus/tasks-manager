<?php

declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use App\Kernel;
use Laminas\Diactoros\ServerRequestFactory;

/** получаем запрос */
$request = ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$kernel = Kernel::getInstance();
$kernel->runHttp($request);
