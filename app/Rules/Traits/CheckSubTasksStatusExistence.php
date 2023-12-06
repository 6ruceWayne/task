<?php

namespace App\Rules\Traits;

use App\Enums\TaskStatusEnum;
use App\Models\Task;

trait CheckSubTasksStatusExistence
{
    private function hasSubTasksStatus(Task $task, TaskStatusEnum $taskStatusEnum, bool $hasSubTasksStatus): bool
    {
        $subTasks = $task->getSubTasks();
        /** @var Task $subTask */
        foreach ($subTasks as $subTask) {
            if ($subTask->getStatus() === $taskStatusEnum) {
                return true;
            }
            $hasSubTasksStatus = $this->hasSubTasksStatus($subTask, $taskStatusEnum, $hasSubTasksStatus);
            if ($hasSubTasksStatus === true) {
                return true;
            }
        }
        return false;
    }
}
