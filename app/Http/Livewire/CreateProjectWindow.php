<?php

namespace App\Http\Livewire;

use App\Models\Project;
use Livewire\Component;

class CreateProjectWindow extends Component
{

    public bool $isWindowOpen;
    public string $projectTitle;
    public string $projectDescription;

    public function mount()
    {
        $this->isWindowOpen = false;
        $this->projectTitle = '';
        $this->projectDescription = '';
    }


    public function getRules()
    {
        return [
            'projectTitle' => ['required', 'string', 'min:3'],
            'projectDescription' => ['string', 'nullable'],
        ];
    }

    protected function getListeners()
    {
        return [
            'openCreateProjectWindow'
        ];
    }

    public function createProject()
    {
        $this->validate();
        $project = new Project([
            'title' => $this->projectTitle,
            'description' => $this->projectDescription,
        ]);
        auth()->user()->projects()->save($project);
        $this->resetForm();
        $this->emitUp('project-created', $project->id);
    }

    public function openCreateProjectWindow()
    {
        $this->isWindowOpen = true;
    }

    public function resetForm()
    {
        $this->projectTitle = '';
        $this->projectDescription = '';
    }

    public function render()
    {
        return view('livewire.create-project-window');
    }
}
