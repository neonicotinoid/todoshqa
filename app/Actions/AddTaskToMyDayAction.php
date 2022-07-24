<?php

namespace App\Actions;

use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;

class AddTaskToMyDayAction
{
    public function __invoke(
        Task $task,
        User $user,
        Carbon $datetime
        ) {
        $user->myDayTasks()->attach($task->id, ['day' => $datetime]);
    }
}
