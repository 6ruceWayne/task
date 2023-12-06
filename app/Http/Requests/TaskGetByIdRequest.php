<?php

namespace App\Http\Requests;

use App\Repositories\TasksRepository;
use App\Rules\CheckTaskUserExistRule;
use Illuminate\Foundation\Http\FormRequest;

class TaskGetByIdRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'id' => [
                'required',
                'int',
                'exists:tasks,id',
                new CheckTaskUserExistRule(
                    $this->user(),
                    app()->make(TasksRepository::class)
                )
            ]
        ];
    }
}
