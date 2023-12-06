<?php

namespace App\Rules;

use App\Enums\TaskStatusEnum;
use App\Repositories\TasksRepository;
use App\Rules\Traits\CheckSubTasksStatusExistence;
use Illuminate\Contracts\Validation\Rule;

class CheckDeletingNotDoneTask implements Rule
{

    use CheckSubTasksStatusExistence;

    public function __construct(private TasksRepository $tasksRepository)
    {
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        $task = $this->tasksRepository->getById((int)$value);
        $hasDoneSubTasks = $this->hasSubTasksStatus(
            task:              $task,
            taskStatusEnum:    TaskStatusEnum::Done,
            hasSubTasksStatus: false
        );
        return $task->getStatus() === TaskStatusEnum::ToDo && $hasDoneSubTasks === false;
    }

    public function message(): string
    {
        return 'Deleting tasks that have Todo status or subTasks with ToDo status is not allowed.';
    }
}
