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
     * @param array $users <Users>
     *
     * @return $this
     */
    public function setUsers(array $users): self
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
     * @param array $tasks <TaskStatuses>
     */
    public function setTaskStatuses(array $taskStatuses): self
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
