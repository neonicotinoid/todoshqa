<?php

namespace App\Http\Livewire;

use App\Actions\ShareProjectToUserAction;
use App\Actions\UnshareProjectToUserAction;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use DebugBar\DebugBar;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Collection;
use Illuminate\Validation\Rule;
use Livewire\Component;

class TasksListPage extends Component
{

    use AuthorizesRequests;

    public Project $project;
    public Collection $actualTasks;
    public Collection $completedTasks;
    public bool $isTaskModalOpen;
    public ?string $taskDeadline;

    public bool $isProjectModalOpen = false;
    public bool $isProjectAccessModalOpen = false;

    public ?Task $openedTask = null;

    public string $newTaskTitle = '';

    public string $sharingEmail = '';

    public function mount(Project $project)
    {
        $this->project = $project;
        $this->project->load('users');
        $this->isTaskModalOpen = false;
    }

    public function rules()
    {
        return [
            'openedTask.title' => ['string', 'required'],
            'openedTask.description' => ['string', 'nullable'],
            'openedTask.deadline_date' => ['date', 'nullable'],
            'newTaskTitle' => ['string', 'required', 'min:3'],

            'project.title' => ['string'],
            'project.description' => ['string', 'nullable'],

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

    public function openProjectSettings()
    {
        $this->isProjectModalOpen = true;
    }

    public function openProjectAccessSettings()
    {
        $this->isProjectAccessModalOpen = true;
    }

    public function openTask(int $id)
    {
        $this->openedTask = Task::find($id);
        $this->isTaskModalOpen = true;
        $this->dispatchBrowserEvent('task-sidebar-open', $this->openedTask);
    }

    public function closeTask()
    {
        $this->openedTask = null;
        $this->isTaskModalOpen = false;
    }

    public function toggleTaskState(Task $task)
    {
        $task->completed_at
            ? $task->completed_at = null
            : $task->completed_at = now();

        $task->save();
    }

    public function addNewTask(): Task
    {
        $this->validateOnly('newTaskTitle');
        $task = new Task(['title' => $this->newTaskTitle]);
        $task->project()->associate($this->project)->save();
        $this->newTaskTitle = '';
        return $task;
    }

    public function saveOpenedTask(): bool
    {
        $this->validateOnly('openedTask.deadline_date');
        return $this->openedTask->save();
    }

    public function resetDeadlineDateForOpenedTask()
    {
        $this->openedTask->deadline_date = null;
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

    public function getActualTasksProperty(): Collection
    {
        return $this->project->tasks()->actual()->get();
    }

    public function getCompletedTasksProperty(): Collection
    {
        return $this->project->tasks()->completed()->get();
    }

    public function render()
    {
        return view('livewire.tasks-list-page');
    }
}
