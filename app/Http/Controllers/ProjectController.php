<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        return view('projects')->with([
            'ownProjects' => auth()->user()->projects,
            'sharedProjects' => auth()->user()->shared_projects
        ]);
    }

    public function show(Request $request, Project $project)
    {
        return view('tasks')->with([
            'project' => $project,
        ]);
    }
}
