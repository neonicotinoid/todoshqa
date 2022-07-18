<?php

namespace App\Actions;

use App\Models\Project;
use App\Models\User;

class ShareProjectToUserAction
{
    public function __invoke(Project $project, User $user): void
    {
        $user->shared_projects()->syncWithoutDetaching($project);
    }
}
