<?php

namespace App\Http\Livewire;


use App\Models\Project;
use App\Models\Task;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use Livewire\Component;

class TasksListPage extends Component
{

    use AuthorizesRequests;

    public Project $project;
    public Collection $actualTasks;
    public Collection $completedTasks;

    public string $newTaskTitle = '';

    public function mount(Project $project)
    {
        $this->project = $project;
        $this->project->load('users');
        $this->isTaskModalOpen = false;
    }

    public function rules()
    {
        return [
            'newTaskTitle' => ['string', 'required', 'min:3'],
        ];
    }

    public function getListeners()
    {
        return [
            'project-updated' => 'updateProjectInfo',
            'task-updated' => '$refresh'
        ];
    }

    public function updateProjectInfo(Project $project)
    {
        $this->project = $project;
    }

    public function openTask(int $id)
    {
        $this->emitTo(SingleTaskWindow::class, 'openTask', $id);
    }

    public function toggleTaskState(Task $task)
    {
        $task->completed_at
            ? $task->completed_at = null
            : $task->completed_at = now();

        $task->save();
    }

    public function addNewTask(): Task
    {
        $this->validateOnly('newTaskTitle');
        $task = new Task(['title' => $this->newTaskTitle]);
        $task->project()->associate($this->project)->save();
        $this->newTaskTitle = '';
        return $task;
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
