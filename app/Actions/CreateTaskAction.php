<?php

namespace App\Actions;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;

class CreateTaskAction
{

    public function __invoke(User|int $user, Project|int $project, array $attributes): Task
    {
        if (is_integer($user)) {
            $user = User::findOrFail($user);
        }

        if (is_integer($project)) {
            $project = Project::findOrFail($project);
        }

        $task = new Task($attributes);
        $task->author()->associate($user);
        $task->project()->associate($project)->save();

        return $task;
    }

}
