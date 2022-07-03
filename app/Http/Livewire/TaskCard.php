<?php

namespace App\Http\Livewire;

use App\Actions\AddTaskToMyDayAction;
use App\Actions\RemoveTaskFromMyDayAction;
use App\Models\Task;
use Livewire\Component;

class TaskCard extends Component
{
    public int $taskId;
    public Task $task;
    public bool $inMyDay;

    public function mount(Task $task)
    {
        $this->task = $task;
        $this->taskId = $this->task->id;
        $this->inMyDay = $this->task->isInMyDay(auth()->user());
    }

    public function refreshTask()
    {
        $this->task->refresh();
    }

    public function openTask(int $id)
    {
        $this->emitTo(SingleTaskWindow::class, 'openTask', $id);
    }

    public function toggleTaskState()
    {
        $this->task->completed_at
            ? $this->task->completed_at = null
            : $this->task->completed_at = now();
        $this->task->save();
        $this->emitUp('task-status-updated');
    }

    public function updatedInMyDay(bool $value)
    {
        if ($value) {
            (new AddTaskToMyDayAction())($this->task, auth()->user(), now());
            return;
        }
        (new RemoveTaskFromMyDayAction())($this->task, auth()->user());
        $this->emitUp('task-added-to-my-day', $this->task->id);
    }

    public function getInMyDayProperty(): bool
    {
        return $this->task->isInMyDay(auth()->user());
    }

    public function render()
    {
        return view('livewire.task-card');
    }
}
