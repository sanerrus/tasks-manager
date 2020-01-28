<?php

namespace App\Services\Tasks;

interface TasksInterface
{
    /**
     * Получение комментариев к задаче.
     *
     * @return array <TaskExtensionInterface>
     */
    public function getTaskExtension(int $tasksId): array;
}
