<?php

namespace App\Policies;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class TaskPolicy
{
    use HandlesAuthorization;

    public function create(User $user, Project $project): bool|Response
    {
        return $project->user->id === $user->id ||
            $user->shared_projects->contains($user->id);
    }

    public function delete(User $user, Task $task)
    {
        return $task->author->id === $user->id ||
            $user->shared_projects->contains($task->project->id);
    }

    public function update(User $user, Task $task)
    {
        return $task->author->id === $user->id ||
            $user->shared_projects->contains($task->project->id);
    }

    public function forceDelete(User $user, Task $task)
    {
        return $task->project->user->id === $user->id;
    }

}
