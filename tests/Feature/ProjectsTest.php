<?php

namespace Tests\Feature;

use App\Actions\ShareProjectToUserAction;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Tests\TestCase;

class ProjectsTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_renders_project()
    {
        $user = User::factory()->has(Project::factory(['id' => 1]), 'projects')->create();
        $this->actingAs($user);

        $this->get(route('projects.show', ['project' => 1]))
            ->assertStatus(200)
            ->assertInertia(function (Assert $page) {
                $page->component('Project');
            });
    }

    public function test_user_can_create_project()
    {
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->postJson(route('projects.store'), [
            'title' => 'New Project',
            'description' => 'Project Description',
        ])->assertStatus(302);

        $this->assertDatabaseHas('projects', [
            'title' => 'New Project',
            'description' => 'Project Description',
            'user_id' => $user->id,
        ]);
    }

    public function test_guest_cant_create_project()
    {
        $this->postJson(route('projects.store'), [
            'title' => 'New Project',
            'description' => 'Project Description',
        ])->assertUnauthorized();

        $this->assertDatabaseMissing('projects', [
            'title' => 'New Project',
            'description' => 'Project Description',
        ]);
    }

    public function test_owner_can_edit_project()
    {
        $user = User::factory()->has(Project::factory(['id' => 1]), 'projects')->create();
        $this->actingAs($user);

        $this->putJson(route('projects.update', ['project' => 1]), [
            'title' => 'New Project Title',
            'description' => 'New Project Description',
        ])->assertStatus(302);

        $this->assertDatabaseHas('projects', [
            'title' => 'New Project Title',
            'description' => 'New Project Description',
            'user_id' => $user->id,
        ]);
    }

    public function test_user_with_access_can_not_edit_project()
    {
        User::factory()
            ->has(Project::factory(['id' => 1])->afterCreating(function (Project $project, User $user) {
                Task::factory(3)
                    ->for($user, 'author')
                    ->for($project, 'project')
                    ->create();
            }), 'projects')
            ->create();
        $sharedUser = User::factory()->create();
        (new ShareProjectToUserAction())(Project::find(1), $sharedUser);

        $this->actingAs($sharedUser);

        $this->putJson(route('projects.update', ['project' => 1]), [
            'title' => 'New Project Title',
            'description' => 'New Project Description',
        ])->assertForbidden();
    }

    public function test_guest_can_not_edit_project()
    {
        $project = Project::factory()->for(User::factory(), 'user')->create();

        $this->putJson(route('projects.update', ['project' => $project->id]), [
            'title' => 'New Project Title',
            'description' => 'New Project Description',
        ])->assertUnauthorized();
    }

    public function test_owner_can_share_and_unshare_project()
    {
        $user = User::factory()->has(Project::factory(['id' => 1]), 'projects')->create();
        $userForSharing = User::factory(['email' => 'testable@example.com'])->create();
        $this->actingAs($user);

        $this->postJson(route('projects.share', ['project' => 1]), [
            'email' => 'testable@example.com',
        ])->assertStatus(302);

        $this->assertDatabaseHas('sharings', [
            'user_id' => $userForSharing->id,
            'project_id' => 1,
        ]);

        $this->postJson(route('projects.unshare', ['project' => 1]), [
            'user_id' => $userForSharing->id,
        ])->assertStatus(302);

        $this->assertDatabaseMissing('sharings', [
            'user_id' => $userForSharing->id,
            'project_id' => 1,
        ]);
    }

    public function test_guest_cannot_share_project()
    {
        $project = Project::factory()->for(User::factory(), 'user')->create();
        User::factory(['email' => 'test@example.com'])->create();

        $this->postJson(route('projects.share', ['project' => $project->id]), [
            'email' => 'test@example.com',
        ])->assertUnauthorized();
    }

    public function test_user_with_access_cannot_share_project()
    {
        User::factory()
            ->has(Project::factory(['id' => 1])->afterCreating(function (Project $project, User $user) {
                Task::factory(3)
                    ->for($user, 'author')
                    ->for($project, 'project')
                    ->create();
            }), 'projects')
            ->create();
        $sharedUser = User::factory()->create();
        User::factory(['email' => 'testable@example.com'])->create();
        (new ShareProjectToUserAction())(Project::find(1), $sharedUser);

        $this->actingAs($sharedUser);

        $this->postJson(route('projects.share', ['project' => 1]), [
            'email' => 'testable@example.com',
        ])->assertForbidden();
    }
}
