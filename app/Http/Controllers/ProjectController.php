<?php

namespace App\Http\Controllers;

use App\Actions\ShareProjectToUserAction;
use App\Actions\UnshareProjectToUserAction;
use App\Http\Requests\ProjectDeleteRequest;
use App\Http\Requests\ProjectShareRequest;
use App\Http\Requests\ProjectStoreRequest;
use App\Http\Requests\ProjectUnshareRequest;
use App\Http\Requests\ProjectUpdateRequest;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        return Inertia::render('Projects', [
            'ownProjects' => auth()->user()->projects,
            'trashedProjects' => auth()->user()->projects()->onlyTrashed()->get(),
            'sharedProjects' => auth()->user()->shared_projects,
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

    public function destroy(ProjectDeleteRequest $request, Project $project)
    {
        $project->delete();

        return redirect()->to(route('projects.index'))->with('success', 'Project deleted');
    }

    public function forceDelete(Request $request, int $project)
    {
        $project = Project::withTrashed()->findOrFail($project);
        $this->authorize('forceDelete', $project);
        $project->tasks()->forceDelete();
        $project->forceDelete();

        return back()->with('success', 'Project deleted');
    }

    public function restore(Request $request, int $project)
    {
        $project = Project::withTrashed()->findOrFail($project);
        $this->authorize('restore', $project);

        $project->tasks()->restore();
        $project->restore();

        return back()->with('success', 'Project restored');
    }

    public function show(Request $request, Project $project)
    {
        $this->authorize('view', $project);
        $actualTasks = $project->tasks()
            ->actual()
            ->when(! $request->sorting || $request->sorting === 'created_desc', function (Builder $query) {
                return $query->orderBy('created_at', 'DESC');
            })
            ->when($request->sorting === 'created_asc', function (Builder $query) {
                return $query->orderBy('created_at', 'ASC');
            })
            ->when($request->sorting === 'deadline', function (Builder $query) {
                return $query->byDeadline();
            })
            ->get();

        $completedTasks = $project->tasks()->completed()->get();

        return Inertia::render('Project', [
            'project' => $project->load('users'),
            'actualTasks' => $actualTasks,
            'completedTasks' => $completedTasks,
        ]);
    }

    public function share(ProjectShareRequest $request, Project $project, ShareProjectToUserAction $sharing)
    {
        /** @var User $user */
        $user = User::where('email', $request->email)->firstOrFail();
        $sharing($project, $user);

        return back()->with('success', 'Project shared');
    }

    public function unshare(ProjectUnshareRequest $request, Project $project, UnshareProjectToUserAction $unsharing)
    {
        $user = User::find($request->user_id);
        $unsharing($project, $user);

        return back()->with('success', 'Project unshared');
    }
}
