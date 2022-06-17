<?php

namespace App\Http\Livewire;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Support\Collection;
use Livewire\Component;

class TasksListPage extends Component
{
    public Project $project;
    public Collection $tasks;
    public bool $isTaskModalOpen;

    public ?Task $openedTask = null;

    public function mount(Project $project)
    {
        $this->project = $project;
        $this->tasks = $project->tasks;
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

    public function render()
    {
        return view('livewire.tasks-list-page');
    }
}
