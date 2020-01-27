<?php

declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use App\Kernel;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\ResponseFactory;
use Laminas\Diactoros\ServerRequestFactory;
use League\Route\Router;
use League\Route\Strategy\JsonStrategy;

/** получаем запрос */
$request = ServerRequestFactory::fromGlobals(
    $_SERVER,
    $_GET,
    $_POST,
    $_COOKIE,
    $_FILES
);

$responseFactory = new ResponseFactory();
$strategy = new JsonStrategy($responseFactory);
$router = (new Router())->setStrategy($strategy);

$router->map('GET', '/test', 'App\Controller\UsersController::index');
$response = $router->dispatch($request)->withHeader('Content-Type', 'text/plain');
//$response = $response
//    ->withHeader('Content-Type', 'application/json');
//header('Content-Type: application/json');
//var_dump($response->getHeaders());
//echo $response->getBody();

//$kernel = Kernel::getInstance();
//$kernel->run();
//var_dump($kernel->getContainer()->get('appConfig'));

//phpinfo();
