<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request, Project $project)
    {
        return view('tasks')->with([
            'project' => $project,
            'tasks' => $project->tasks,
        ]);
    }
}
