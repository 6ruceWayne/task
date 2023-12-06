<?php

namespace App\Rules;

use App\Enums\TaskStatusEnum;
use App\Repositories\TasksRepository;
use App\Rules\Traits\CheckSubTasksStatusExistence;
use Illuminate\Contracts\Validation\Rule;

class CheckTaskSubTasksStatusesRule implements Rule
{
    private int $id;

    use CheckSubTasksStatusExistence;

    public function __construct(int $id, private TasksRepository $tasksRepository)
    {
        $this->id = $id;
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
        $updatedStatus = TaskStatusEnum::from($value);
        $task = $this->tasksRepository->getById($this->id);
        if ($updatedStatus === $task->getStatus()) {
            return true;
        }
        if ($updatedStatus === TaskStatusEnum::ToDo && $task->getStatus() === TaskStatusEnum::Done) {
            return false;
        }
        return !$this->hasSubTasksStatus(task: $task, taskStatusEnum: TaskStatusEnum::Done, hasSubTasksStatus: false);
    }

    public function message(): string
    {
        return 'The task has unfinished sub tasks.';
    }
}
