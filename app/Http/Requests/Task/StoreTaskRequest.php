<?php

namespace App\Http\Requests\Task;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->can('create', [Task::class, Project::find($this->project_id)]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'title' => ['string', 'required', 'min:3'],
            'project_id' => ['required', 'integer', 'exists:projects,id'],
        ];
    }
}
