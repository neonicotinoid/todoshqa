<?php

namespace App\Http\Controllers;

use App\Http\Requests\Task\UpdateTaskRequest;
use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{
    public function show(Request $request, Task $task)
    {
        return view('task')->with([
            'task' => $task
        ]);
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->fill($request->only(['title', 'description']))->save();
        return redirect()->back()->with('success', 'Task updated');

    }

    public function completeTask(Request $request, Task $task)
    {
        $this->authorize('update', $task);
        $task->completed_at ?
            $task->completed_at = null :
            $task->completed_at = now();
        $task->save();


    }

    public function myDay(Request $request)
    {
        return view('myday');
    }
}
