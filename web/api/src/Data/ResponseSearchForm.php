<?php

namespace App\Data;

use App\Entity\TaskStatuses;
use App\Entity\Users;

class ResponseSearchForm implements DataInterface, ResetInterface
{
    private ?iterable $users;

    private ?iterable $taskStatuses;

    /**
     * ResponseSearchForm constructor.
     */
    public function __construct()
    {
        $this->users = null;
        $this->taskStatuses = null;
    }

    /**
     * Заполняем поле пользователей.
     *
     * @param iterable $users <Users>
     *
     * @return $this
     */
    public function setUsers(iterable $users): self
    {
        foreach ($users as $user) {
            if (!($user instanceof Users)) {
                continue;
            }

            $this->users[] = $user->toArray();
        }

        return $this;
    }

    /**
     * Заполняем поле статусов задач.
     *
     * @param iterable $tasks <TaskStatuses>
     */
    public function setTaskStatuses(iterable $taskStatuses): self
    {
        foreach ($taskStatuses as $taskStatus) {
            if (!($taskStatus instanceof TaskStatuses)) {
                continue;
            }

            $this->taskStatuses[] = $taskStatus->toArray();
        }

        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function toIterable(): iterable
    {
        return [
            'users' => $this->users,
            'taskStatuses' => $this->taskStatuses,
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function reset(): ResetInterface
    {
        $this->users = null;
        $this->taskStatuses = null;

        return $this;
    }
}
