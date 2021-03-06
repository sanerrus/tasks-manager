<?php

namespace App\Services;

use App\AbstractInjector;
use App\Data\ResponseSearchForm;
use App\Services\Tasks\TaskExtension\TaskExtensionInterface;
use App\Services\Tasks\TaskStatuses\TaskStatusesInterface;
use App\Services\Users\UsersInterface;

class Service extends AbstractInjector implements ServiceInterface
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
     * @var TaskStatusesInterface
     *
     * @Inject taskStatuses
     */
    protected TaskStatusesInterface $taskStatuses;

    /**
     * Сервис работы с комментариями к задаче.
     *
     * @var TaskExtensionInterface
     *
     * @Inject taskExtension
     */
    protected TaskExtensionInterface $taskExtension;

    /**
     * {@inheritdoc}
     */
    public function getResponseSearchForm(): ResponseSearchForm
    {
        // TODO: реализовать работу со структурой ResponseSearchForm через redis

        $users = $this->user->findAll();
        $taskStatuses = $this->taskStatuses->findAll();
        $responseSearchForm = new ResponseSearchForm();
        $responseSearchForm->setUsers($users);
        $responseSearchForm->setTaskStatuses($taskStatuses);
        $users = null;
        $taskStatuses = null;

        return $responseSearchForm;
    }
}
