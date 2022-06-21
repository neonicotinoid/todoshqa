<?php

namespace App\Http\Livewire;

use App\Models\Project;
use Livewire\Component;

class ProjectEditWindow extends Component
{
    public Project $project;
    public bool $isWindowOpen = false;

    public function mount(Project $project)
    {
        $this->project = $project;
    }

    protected function getListeners()
    {
        return [
            'openProjectEditWindow' => 'openWindow',
        ];
    }

    public function rules(): array
    {
        return [
            'project.title' => ['string'],
            'project.description' => ['string', 'nullable'],
        ];
    }

    public function openWindow()
    {
        $this->isWindowOpen = true;
    }

    public function closeWindow()
    {
        $this->isWindowOpen = false;
    }


    public function saveProject()
    {
        $this->validate();
        $this->project->save();
        $this->emitTo(TasksListPage::class, 'project-updated', $this->project);
    }

    public function render()
    {
        return view('livewire.project-edit-window');
    }
}
