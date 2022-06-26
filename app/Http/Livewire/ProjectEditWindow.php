<?php

namespace App\Http\Livewire;

use App\Models\Project;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Validator;
use Livewire\Component;

class ProjectEditWindow extends Component
{
    use AuthorizesRequests;

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
            'project.title' => ['string', 'required'],
            'project.description' => ['string', 'nullable'],
        ];
    }

    protected function getMessages()
    {
        return [
            'project.title.required' => 'Заголовок для проекта обязателен'
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
        $this->authorize('update', $this->project);
        $this->validate();
        $this->project->save();
        $this->emitTo(TasksListPage::class, 'project-updated', $this->project);
        $this->dispatchBrowserEvent('projectUpdated');
    }

    public function render()
    {
        return view('livewire.project-edit-window');
    }
}
