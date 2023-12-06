<?php

namespace App\Http\Requests;

use App\Enums\TaskPriorityEnum;
use App\Enums\TaskStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class TaskGetBySearchFilterRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'byText' => ['sometimes', 'string', 'min:1', 'max:255'],
            'byStatus' => ['sometimes', 'string', Rule::in(TaskStatusEnum::values())],
            'byPriority' => ['sometimes', 'int', Rule::in(TaskPriorityEnum::values())],
            'sortByStatus' => ['sometimes', 'bool'],
            'sortByPriority' => ['sometimes', 'bool'],
            'sortByCreatedAt' => ['sometimes', 'bool'],
            'sortByCompletedAt' => ['sometimes', 'bool'],
        ];
    }
}
