<?php

namespace App\Http\Controllers;

use App\Actions\AddTaskToMyDayAction;
use App\Actions\RemoveTaskFromMyDayAction;
use App\Http\Requests\Task\StoreTaskRequest;
use App\Http\Requests\Task\UpdateTaskRequest;
use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Inertia\Inertia;

class TaskController extends Controller
{

    public function store(StoreTaskRequest $request)
    {
        $task = new Task();
        $task->fill(['user_id' => auth()->user()->id, ...$request->validated()]);
        $task->author()->associate(auth()->user());
        $task->project()->associate(Project::find($request->project_id))->save();

        return \Redirect::back()->with('success', 'Task created');
    }

    public function show(Request $request, Task $task)
    {
        return Inertia::render('Task', [
           'task' => $task->load('project'),
        ]);
    }

    public function update(UpdateTaskRequest $request, Task $task)
    {
        $task->fill($request->only(['title', 'description', 'deadline_date']))->save();
        return redirect()->back()->with('success', 'Task updated');

    }

    public function completeTask(Request $request, Task $task)
    {
        $this->authorize('update', $task);
        $task->completed_at ?
            $task->completed_at = null :
            $task->completed_at = now();
        $task->save();

        return redirect()->back()->with('success', 'Task completed');
    }

    public function toggleToMyDay(Request $request, Task $task, AddTaskToMyDayAction $add, RemoveTaskFromMyDayAction $remove)
    {
        // TODO: Auth

        if ($task->isInMyDay(auth()->user())) {
            $remove($task, auth()->user());
        } else {
            $add($task, auth()->user(), now());
        }

        return redirect()->back()->with('success');
    }

    public function destroy(Request $request, Task $task)
    {
        $this->authorize('forceDelete', $task);
        $task->forceDelete();

        return redirect()->back()->with('success', 'Task removed');
    }
}
