<?php

namespace App\Actions;

use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Validator;

class RemoveTaskFromMyDayAction
{

    public function __invoke(
        Task $task,
        User $user,
    ): int
    {
        return $user->myDayTasks()->detach($task->id);
    }

}
