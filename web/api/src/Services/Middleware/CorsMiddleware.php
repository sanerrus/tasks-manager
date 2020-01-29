<?php

namespace App\Services\Middleware;

use Laminas\Diactoros\Response;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;

class CorsMiddleware implements MiddlewareInterface
{
    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        header('Access-Control-Allow-Origin: http://tasks-manager.local');
        header('Access-Control-Request-Method: GET, POST, PUT');
        header('Access-Control-Allow-Headers: X-Custom-Header'); // ?
//        $response = $handler->handle($request);
//        $response->withHeader('Access-Control-Allow-Origin', '*'); // Хоть убей не добавляется таким способом, надо разбираться

        return $handler->handle($request);
    }
}
