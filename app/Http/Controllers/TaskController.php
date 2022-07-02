<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function show(Request $request, Task $task)
    {
        return view('task')->with([
            'task' => $task
        ]);
    }

    public function myDay(Request $request)
    {
        return view('myday');
    }
}
