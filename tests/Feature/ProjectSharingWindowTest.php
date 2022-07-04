<?php

namespace Tests\Feature;

use App\Actions\ShareProjectToUserAction;
use App\Http\Livewire\ProjectSharingWindow;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ProjectSharingWindowTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_renders_component()
    {
        $owner = User::factory()
            ->has(Project::factory(['id' => 1])->afterCreating(function (Project $project, User $user) {
                Task::factory(3)
                    ->for($user, 'author')
                    ->for($project, 'project')
                    ->create();
            })
                , 'projects')
            ->create();

        $this->actingAs($owner)
            ->get(route('project.show', ['project' => 1]))
            ->assertSeeLivewire(ProjectSharingWindow::class);
    }

    public function test_owner_can_share_project_to_user()
    {
        $owner = User::factory()
            ->has(Project::factory(['id' => 1])->afterCreating(function (Project $project, User $user) {
                Task::factory(3)
                    ->for($user, 'author')
                    ->for($project, 'project')
                    ->create();
            })
                , 'projects')
            ->create();
        $userForSharing = User::factory(['name' => 'Username', 'email' => 'testable@mail.com'])->create();

        Livewire::actingAs($owner)
            ->test(ProjectSharingWindow::class, ['project' => Project::find(1)])
            ->set('sharingEmail', 'testable@mail.com')
            ->call('giveAccessToUser')
            ->assertSee(['Username', 'testable@mail.com']);

        $this->assertTrue($userForSharing->shared_projects->contains(1));
    }

    public function test_owner_can_unshare_project_from_user()
    {
        $owner = User::factory()
            ->has(Project::factory(['id' => 1])->afterCreating(function (Project $project, User $user) {
                Task::factory(3)
                    ->for($user, 'author')
                    ->for($project, 'project')
                    ->create();
            })
                , 'projects')
            ->create();
        $userWithSharedAccess = User::factory(['name' => 'Username', 'email' => 'testable@mail.com'])->create();
        (new ShareProjectToUserAction())(Project::find(1), $userWithSharedAccess);

        Livewire::actingAs($owner)
            ->test(ProjectSharingWindow::class, ['project' => Project::find(1)])
            ->assertSee(['Username', 'testable@mail.com'])
            ->call('removeAccessFromUser', $userWithSharedAccess)
            ->assertDontSee(['Username', 'testable@mail.com']);

        $this->assertFalse($userWithSharedAccess->shared_projects->contains(1));
    }

    public function test_user_with_access_cannot_change_settings()
    {
        User::factory()
            ->has(Project::factory(['id' => 1])->afterCreating(function (Project $project, User $user) {
                Task::factory(3)
                    ->for($user, 'author')
                    ->for($project, 'project')
                    ->create();
            })
                , 'projects')
            ->create();

        $userWithSharedAccess =
            User::factory(['name' => 'Username', 'email' => 'testable@mail.com'])
                ->hasAttached(Project::find(1), [], 'shared_projects')
                ->create();

       Livewire::actingAs($userWithSharedAccess)
           ->test(ProjectSharingWindow::class, ['project' => Project::find(1)])
           ->assertSee('Вы не владелец проекта и не можете управлять настройками доступа')
           ->call('giveAccessToUser')
           ->assertForbidden()
           ->call('removeAccessFromUser')
           ->assertForbidden();
    }

}
