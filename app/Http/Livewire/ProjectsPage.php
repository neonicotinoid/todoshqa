<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Collection;

/**
 * @property Collection projects;
 * @property Collection sharedProjects;
 */

class ProjectsPage extends Component
{
    public User $user;

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function getListeners()
    {
        return [
            'project-created' => '$refresh',
        ];
    }

    public function getProjectsProperty()
    {
        return $this->user->projects;
    }

    public function getSharedProjectsProperty()
    {
        return $this->user->shared_projects;
    }

    public function render()
    {
        return view('livewire.projects-page');
    }
}
