<?php

namespace App\Actions;

use App\Models\Project;
use App\Models\User;

class UnshareProjectToUserAction
{
    public function __invoke(Project $project, User $user): void
    {
        $user->shared_projects()->detach($project->id);
    }
}
