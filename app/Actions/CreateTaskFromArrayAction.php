<?php

namespace App\Actions;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;

class CreateTaskFromArrayAction
{
    public function __invoke(array $data, Project $project, User $user): Task
    {
        $task = new Task($data);
        $task->author()->associate($user);
        $task->project()->associate($project)->save();
        return $task;
    }
}
