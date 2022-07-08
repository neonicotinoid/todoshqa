<?php

namespace App\Http\Livewire;

use App\Actions\CreateTaskFromArrayAction;
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
    public array $task = ['title' => ''];

    public function mount(Project $project, string $sortBy = 'created_desc')
    {
//      TODO: Сортировку можно представить в виде Enum
        $this->project = $project;
        $this->project->load('users');
        $this->sortBy = $sortBy;
    }

    public function rules()
    {
        return [
            'task.title' => ['string', 'required', 'min:3'],
        ];
    }

    public function getListeners()
    {
        return [
            'project-updated' => 'updateProjectInfo',
            'task-status-updated' => 'render',
            'task-deleted' => 'render',
        ];
    }

    public function updateProjectInfo(Project $project)
    {
        $this->project = $project;
    }

    public function addNewTask()
    {
        $this->authorize( 'create', [Task::class, $this->project]);
        $this->validate();
        app(CreateTaskFromArrayAction::class)($this->task, $this->project, auth()->user());
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->task = ['title' => ''];
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
