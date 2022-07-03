<?php

namespace App\Http\Livewire;

use App\Models\Task;
use Livewire\Component;

class SingleTaskWindow extends Component
{

    public bool $isOpen = false;

    public ?Task $task = null;

    public function mount()
    {

    }

    protected function getRules()
    {
        return [
            'task.title' => ['string', 'required'],
            'task.description' => ['string', 'nullable'],
            'task.deadline_date' => ['date', 'nullable'],
        ];
    }

    protected function getListeners()
    {
        return [
            'openTask' => 'openTask',
        ];
    }

    public function openTask(Task $task)
    {
        $this->isOpen = true;
        $this->task = $task;
        $this->dispatchBrowserEvent('task-sidebar-open', $this->task);
    }

    public function saveTask()
    {
//      TODO: Auth
        $this->validate();
        $this->task->save();
        $this->emit('task-updated', $this->task->id);
    }

    public function resetDeadline()
    {
        $this->task->deadline_date = null;
    }

    public function render()
    {
        return view('livewire.single-task-window');
    }
}
