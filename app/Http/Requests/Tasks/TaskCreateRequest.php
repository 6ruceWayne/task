<?php

namespace App\Http\Requests\Tasks;

use App\Repositories\TasksRepository;
use App\Rules\CheckTaskUserExistRule;
use Illuminate\Foundation\Http\FormRequest;

class TaskCreateRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'min:1', 'max:50'],
            'description' => ['required', 'min:1', 'max:255'],
            'parentId' => [
                'sometimes',
                'int',
                'exists: tasks,id',
                new CheckTaskUserExistRule($this->user(), app()->make(TasksRepository::class))
            ],
        ];
    }
}
