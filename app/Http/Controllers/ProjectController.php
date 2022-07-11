<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Models\Project;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Projects', [
            'ownProjects' => auth()->user()->projects,
            'sharedProjects' => auth()->user()->shared_projects
        ]);
    }

    public function store(ProjectStoreRequest $request)
    {
        $project = new Project($request->validated());
        auth()->user()->projects()->save($project);

        return back()->with('success', 'Project created');
    }

    public function update(ProjectUpdateRequest $request, Project $project)
    {
        $project->fill($request->only('title', 'description'));
        $project->save();

        return back()->with('success', 'Project updated');

    }

    public function show(Request $request, Project $project)
    {
        $this->authorize('view', $project);
        $actualTasks = $project->tasks()
            ->actual()
            ->when(!$request->sorting || $request->sorting === 'created_desc', function (Builder $query) {
                return $query->orderBy('created_at', 'DESC');
            })
            ->when($request->sorting === 'created_asc', function (Builder $query) {
                return $query->orderBy('created_at', 'ASC');
            })
            ->when($request->sorting === 'deadline', function (Builder $query) {
                return $query->orderByRaw("ifnull(deadline_date, '9999-12-31') ASC");
            })
            ->get();

        $completedTasks = $project->tasks()->completed()->get();

        return Inertia::render('Project', [
            'project' => $project,
            'actualTasks' => $actualTasks,
            'completedTasks' => $completedTasks
        ]);
    }
}
