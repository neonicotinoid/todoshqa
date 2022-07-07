<?php

namespace App\Http\Livewire;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
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

    use AuthorizesRequests;

    public User $user;
    public ?Project $interactionProject;
    public bool $isTrashConfirmationOpen = false;
    public bool $isForceDeleteConfirmationOpen = false;

    public function mount()
    {
        $this->user = auth()->user();
    }

    public function getListeners()
    {
        return [
            'project-created' => 'render',
            'project-updated' => 'render',
        ];
    }

    public function askToTrashProject(Project $project)
    {
        $this->interactionProject = $project;
        $this->isTrashConfirmationOpen = true;
    }

    public function moveProjectToTrash(Project $project)
    {
        $this->authorize('delete', $project);
        $project->delete();
        $this->isTrashConfirmationOpen = false;
        $this->interactionProject = null;
        $this->user->refresh();
    }

    public function askToForceDeleteProject(int $projectId)
    {
        $project = Project::withTrashed()->find($projectId);
        $this->interactionProject = $project;
        $this->isForceDeleteConfirmationOpen = true;
    }

    public function forceDeleteProject(int $projectId)
    {
        $project = Project::withTrashed()->find($projectId);
        $this->authorize('forceDelete', $project);

        $project->tasks()->forceDelete();
        $project->forceDelete();

        $this->isForceDeleteConfirmationOpen = false;
        $this->interactionProject = null;
        $this->user->refresh();
    }

    public function restoreProject(int $projectId)
    {
        $project = Project::onlyTrashed()->findOrFail($projectId);
        $this->authorize('restore', $project);
        $project->restore();
        $this->user->refresh();
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
