<?php

namespace App\Http\Livewire;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use Livewire\Component;

/**
 * @property Collection actualTasks;
 * @property Collection completedTasks;
 */

class TasksListPage extends Component
{

    use AuthorizesRequests;

    public Project $project;
    public string $sortBy;
    public string $newTaskTitle = '';

    public function mount(Project $project)
    {
        $this->project = $project;
        $this->project->load('users');
        $this->sortBy = 'created_desc';
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
            'task-status-updated' => 'render',
        ];
    }

    public function updateProjectInfo(Project $project)
    {
        $this->project = $project;
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
        return $this->project
            ->tasks()
            ->actual()
            ->when($this->sortBy === 'created_desc', function (Builder $query) {
                return $query->orderBy('created_at', 'DESC');
            })
            ->when($this->sortBy === 'created_asc', function (Builder $query) {
                return $query->orderBy('created_at', 'ASC');
            })
            ->when($this->sortBy === 'deadline', function (Builder $query) {
                return $query->orderByRaw("ifnull(deadline_date, '9999-12-31') ASC");
            })
            ->get();
    }

    public function getCompletedTasksProperty(): Collection
    {
        return $this->project
            ->tasks()
            ->completed()
            ->orderBy('completed_at', 'DESC')
            ->get();
    }

    public function render()
    {
        return view('livewire.tasks-list-page');
    }
}
