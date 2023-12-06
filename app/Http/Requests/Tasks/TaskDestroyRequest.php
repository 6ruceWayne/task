<?php

namespace App\Http\Requests\Tasks;

use App\Repositories\TasksRepository;
use App\Rules\CheckDeletingNotDoneTask;
use App\Rules\CheckTaskUserExistRule;
use Illuminate\Foundation\Http\FormRequest;

class TaskDestroyRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'int',
                'min:1',
                'exists:tasks,id',
                new CheckTaskUserExistRule($this->user(), app()->make(TasksRepository::class)),
                new CheckDeletingNotDoneTask(app()->make(TasksRepository::class))
            ]
        ];
    }
}
