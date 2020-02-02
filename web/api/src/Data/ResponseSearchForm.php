<?php

namespace App\Data;

use App\Entity\TaskStatuses;
use App\Entity\Users;

class ResponseSearchForm
{
    private array $users;

    private array $taskStatuses;

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
     * Преобразуем данные объекта в массив.
     */
    public function toArray(): array
    {
        return [
            'users' => $this->users,
            'taskStatuses' => $this->taskStatuses,
        ];
    }
}
