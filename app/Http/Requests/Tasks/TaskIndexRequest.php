<?php

namespace App\Http\Requests\Tasks;

use Illuminate\Foundation\Http\FormRequest;

class TaskIndexRequest extends FormRequest
{

    public function rules(): array
    {
        return [
            'pageIndex' => ['sometimes', 'int', 'min:1'],
            'amount' => ['sometimes', 'int', 'min:1'],
        ];
    }
}
