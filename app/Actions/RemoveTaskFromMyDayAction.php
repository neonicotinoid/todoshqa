<?php

namespace App\Actions;

use App\Models\Task;
use App\Models\User;

class RemoveTaskFromMyDayAction
{
    public function __invoke(
        Task $task,
        User $user,
    ): int {
        return $user->myDayTasks()->detach($task->id);
    }
}
