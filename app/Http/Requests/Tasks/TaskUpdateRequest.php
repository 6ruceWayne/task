<?php

namespace App\Http\Requests\Tasks;

use App\Enums\TaskPriorityEnum;
use App\Enums\TaskStatusEnum;
use App\Repositories\TasksRepository;
use App\Rules\CheckTaskSubTasksStatusesRule;
use App\Rules\CheckTaskUserExistRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskUpdateRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'min:1',
                'exists:tasks,id',
                new CheckTaskUserExistRule($this->user(), app()->make(TasksRepository::class))
            ],
            'title' => ['required', 'string', 'min:1', 'max:50'],
            'description' => ['required', 'min:1', 'max:255'],
            'status' => [
                'required',
                'string',
                Rule::in(TaskStatusEnum::values()),
                new CheckTaskSubTasksStatusesRule($this->id, app()->make(TasksRepository::class))
            ],
            'priority' => ['required', 'integer', Rule::in(TaskPriorityEnum::values())]
        ];
    }
}
