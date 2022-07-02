<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Collection;
use Livewire\Component;

class MyDayTasksPage extends Component
{
    public User $user;
    public bool $isCompletedTasksOpen;

    public function mount(User $user)
    {
        $this->user = $user;
    }

    public function getListeners(): array
    {
        return [
            'task-status-updated' => '$refresh',
        ];
    }

    public function getDayTasksProperty(): Collection
    {
        return auth()->user()
            ->myDayTasks()
            ->actual()
            ->get();
    }

    public function getDayCompletedTasksProperty(): Collection
    {
        return $this->user
            ->myDayTasks()
            ->completed()
            ->orderBy('completed_at', 'DESC')
            ->get();
    }

    public function render()
    {
        return view('livewire.my-day-tasks-page');
    }
}
