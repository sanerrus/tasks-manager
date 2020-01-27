<?php

declare(strict_types=1);

require __DIR__.'/../vendor/autoload.php';

use App\Kernel;
use Laminas\Diactoros\Response;
use Laminas\Diactoros\ResponseFactory;
use Laminas\Diactoros\ServerRequestFactory;
use League\Route\Route;
use League\Route\Router;
use League\Route\Strategy\JsonStrategy;
use Psr\Http\Message\ServerRequestInterface;

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

// map a route
$router->map('GET', '/test', function (ServerRequestInterface $request): array {
    return [
        'test1' => 'test check',
    ];
});

$response = $router->dispatch($request); //->withHeader('Content-Type', 'text/plain');
//$response = $response
//    ->withHeader('Content-Type', 'application/json');
header('Content-Type: application/json');
echo $response->getBody();

$kernel = Kernel::getInstance();
$kernel->run();
//var_dump($kernel->getContainer()->get('appConfig'));

//phpinfo();
