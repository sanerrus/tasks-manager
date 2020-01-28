<?php

namespace App\Controller;

use App\Services\Tasks\TaskExtension\TaskExtensionInterface;
use App\Services\Tasks\TasksInterface;
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

    /**
     * Сервис работы с задачами.
     *
     * @var TasksInterface
     *
     * @Inject tasks
     */
    protected TasksInterface $tasks;

    /**
     * Сервис работы с комментариями к задаче.
     *
     * @var TaskExtensionInterface
     *
     * @Inject taskExtension
     */
    protected TaskExtensionInterface $taskExtension;

    public function index(ServerRequestInterface $request): array
    {
//        var_dump($this->tasks->getTaskExtension(1));
//        var_dump($this->taskStatuses);
//        var_dump($request->getMethod());

        return [
            'test1' => 'test check',
        ];
    }
}
