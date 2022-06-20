<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        return view('projects');
    }

    public function show(Request $request, Project $project)
    {
        return view('tasks')->with([
            'project' => $project,
        ]);
    }
}
