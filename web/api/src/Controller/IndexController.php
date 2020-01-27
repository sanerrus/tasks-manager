<?php

namespace App\Controller;

use App\Services\Resp;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;

class IndexController
{
    public function index(ServerRequestInterface $reques): ResponseInterface
    {
        var_dump($reques);

        return new Resp();
    }
}
