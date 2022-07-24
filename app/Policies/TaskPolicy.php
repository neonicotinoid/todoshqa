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

    public function view(User $user, Task $task): bool|Response
    {
        return ($task->project->user->id === auth()->user()->id ||
            auth()->user()->shared_projects->contains($task->project->id)) ?
            Response::allow() :
            Response::deny('You can\'t view this task');
    }

    public function create(User $user, Project $project): bool|Response
    {
        return ($project->user->id === $user->id || $user->shared_projects->contains($project->id)) ?
            Response::allow() :
            Response::deny('You can\'t create task in this project');
    }

    public function delete(User $user, Task $task)
    {
        return ($task->author->id === $user->id ||
            $user->shared_projects->contains($task->project->id)) ?
            Response::allow() :
            Response::deny('You can\'t remove this task');
    }

    public function update(User $user, Task $task)
    {
        return $task->author->id === $user->id ||
            $user->shared_projects->contains($task->project->id);
    }

    public function forceDelete(User $user, Task $task)
    {
        return $task->project->user->id === $user->id || $task->author->id === $user->id;
    }
}
