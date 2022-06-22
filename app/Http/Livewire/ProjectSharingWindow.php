<?php

namespace App\Http\Livewire;

use App\Actions\ShareProjectToUserAction;
use App\Actions\UnshareProjectToUserAction;
use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Validation\Rule;
use Livewire\Component;

class ProjectSharingWindow extends Component
{
    use AuthorizesRequests;

    public Project $project;
    public string $sharingEmail = '';

    public bool $isWindowOpen = false;

    public function mount(Project $project)
    {
        $this->project = $project;
    }

    public function rules(): array
    {
        return [
            'sharingEmail' => ['required', 'email',
                Rule::exists('users', 'email')
                    ->where(function ($query) {return $query->where('id', '!=', $this->project->user->id);}
                    )],
        ];
    }

    protected array $messages = [
        'sharingEmail.required' => 'Введите email пользователя',
        'sharingEmail.email' => 'Невалидный формат email-адреса',
        'sharingEmail.exists' => 'Не найден пользователь с таким email'
    ];

    protected function getListeners()
    {
        return [
            'openProjectSharingWindow' => 'openWindow'
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

    public function getUser()
    {
        return auth()->user();
    }

    public function giveAccessToUser(ShareProjectToUserAction $action)
    {
        $this->authorize('share', $this->project);
        $this->validateOnly('sharingEmail');
        $action($this->project, User::query()->where('email', $this->sharingEmail)->first());
        $this->project->load('users');
    }

    public function removeAccessFromUser(UnshareProjectToUserAction $action, User $user)
    {
        $this->authorize('share', $this->project);
        $action($this->project, $user);
        $this->project->load('users');
    }

    public function render()
    {
        return view('livewire.project-sharing-window');
    }
}
