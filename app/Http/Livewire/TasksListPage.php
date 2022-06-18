<?php

namespace App\Http\Livewire;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Collection;
use Livewire\Component;

class TasksListPage extends Component
{
    public Project $project;
    public Collection $actualTasks;
    public Collection $completedTasks;
    public bool $isTaskModalOpen;

    public ?Task $openedTask = null;

    public function mount(Project $project)
    {
        $this->project = $project;
        $this->isTaskModalOpen = false;
    }

    public function rules()
    {
        return [
            'openedTask.title' => ['string', 'required'],
            'openedTask.description' => ['string', 'nullable']
        ];
    }

    public function openTask(int $id)
    {
        $this->openedTask = Task::find($id);
        $this->isTaskModalOpen = true;
    }

    public function closeTask()
    {
        $this->openedTask = null;
        $this->isTaskModalOpen = false;
    }

    public function toggleTaskState(Task $task)
    {
        if ($task->completed_at) {
            $task->completed_at = null;
        } else {
            $task->completed_at = now();
        }
        $task->save();
        $this->emit('update');
    }

    public function getActualTasksProperty(): Collection
    {
        return $this->project->tasks()->actual()->get();
    }

    public function getCompletedTasksProperty(): Collection
    {
        return $this->project->tasks()->completed()->get();
    }

    public function render()
    {
        return view('livewire.tasks-list-page');
    }
}
