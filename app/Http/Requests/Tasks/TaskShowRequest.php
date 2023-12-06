<?php

namespace App\Http\Requests\Tasks;

use Illuminate\Foundation\Http\FormRequest;

class TaskShowRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'id' => ['required', 'int', 'min:1', 'exists:tasks,id']
        ];
    }
}
