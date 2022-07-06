<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;
use Illuminate\Support\Collection;

/**
 * @property Collection projects;
 * @property Collection sharedProjects;
 * @property Collection trashedProjects;
 */

// TODO: Добавить интерфейс и логику delete, forceDelete и restore
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

    public function getProjectsProperty(): Collection
    {
        return $this->user->projects;
    }

    public function getSharedProjectsProperty(): Collection
    {
        return $this->user->shared_projects;
    }

    public function getTrashedProjectsProperty(): Collection
    {
        return $this->user->projects()->onlyTrashed()->get();
    }

    public function render()
    {
        return view('livewire.projects-page');
    }
}
