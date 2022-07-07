<?php

namespace App\Http\Livewire;

use App\Actions\AddTaskToMyDayAction;
use App\Actions\RemoveTaskFromMyDayAction;
use App\Models\Task;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class SingleTaskWindow extends Component
{

    use AuthorizesRequests;

    public bool $isOpen = false;
    public ?Task $task = null;
    public ?bool $inMyDay = null;

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
        $this->inMyDay = $this->task->isInMyDay(auth()->user());
        $this->dispatchBrowserEvent('task-sidebar-open', $this->task);
    }

    public function saveTask()
    {
        $this->authorize('update', $this->task);
        $this->validate();
        $this->task->save();
        $this->emit('task-updated', $this->task->id);
    }

    public function resetDeadline()
    {
        $this->task->deadline_date = null;
    }

    public function toggleInMyDay(AddTaskToMyDayAction $add, RemoveTaskFromMyDayAction $remove)
    {
        $this->authorize('update', $this->task);

        $this->inMyDay
            ? $remove($this->task, auth()->user())
            : $add($this->task, auth()->user(), now());

        $this->refreshTask();
        $this->emit('task-updated', $this->task->id);
    }

    public function refreshTask()
    {
        $this->task->refresh();
        $this->inMyDay = $this->task->isInMyDay(auth()->user());
    }

    public function render()
    {
        return view('livewire.single-task-window');
    }
}
