<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Livewire\Component;

class SingleTaskPage extends Component
{
    public Task $task;

    public function mount(Task $task)
    {
        $this->task = $task;
    }

    protected function rules()
    {
        return [
            'task.title' => ['required', 'string', 'min:1'],
            'task.description' => ['string', 'nullable'],
            'task.deadline_date' => ['date', 'nullable'],
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function resetDeadline()
    {
        $this->task->deadline_date = null;
    }

    public function saveTask()
    {
        $this->validate();
        $this->task->save();
    }

    public function render()
    {
        return view('livewire.single-task-page');
    }
}
