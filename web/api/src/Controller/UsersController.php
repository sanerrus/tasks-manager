<?php

namespace App\Controller;

use App\Services\Users\UsersInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * Class UsersController.
 */
class UsersController extends AbstractController
{
    /**
     * Сервис работы с пользователями.
     *
     * @var UsersInterface
     *
     * @Inject usersService
     */
    protected UsersInterface $user;

    public function index(ServerRequestInterface $request): array
    {
        var_dump($this->user->findAll());
//        var_dump($request->getMethod());

        return [
            'test1' => 'test check',
        ];
    }
}
