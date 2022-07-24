<?php

namespace App\Http\Requests\Task;

use App\Models\Task;
use Illuminate\Auth\Access\Response;
use Illuminate\Foundation\Http\FormRequest;

class UpdateTaskRequest extends FormRequest
{
    public function authorize(): bool|Response
    {
        return auth()->user()->can('update', Task::find($this->get('id')));
    }

    public function rules(): array
    {
        return [
            'id' => ['integer', 'exists:tasks,id'],
            'title' => ['required', 'string', 'min:3'],
            'description' => ['string', 'nullable'],
            'deadline_date' => ['date', 'nullable'],
        ];
    }
}
