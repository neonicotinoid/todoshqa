<?php

namespace App\Actions;

use App\Models\MyDayTask;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class AddTaskToMyDayAction
{
    public function __invoke(
        Task $task,
        User $user,
        Carbon $datetime
        )
    {
        $user->myDayTasks()->attach($task->id, ['day' => $datetime]);
    }
}
