<?php

namespace Tests\Feature;

use App\Actions\ShareProjectToUserAction;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Inertia\Testing\AssertableInertia as Assert;
use Livewire\Livewire;
use Tests\TestCase;

class TasksListPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_accessible_for_owner()
    {
        $this->actingAs(User::factory()
            ->has(Project::factory(['id' => 1])->afterCreating(function (Project $project, User $user) {
                Task::factory(3)
                    ->for($user, 'author')
                    ->for($project, 'project')
                    ->create();
            })
                , 'projects')
            ->create());

        $this->get(route('project.show', ['project' => 1]))
            ->assertStatus(200);
    }

    public function test_it_accessible_for_shared_user()
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

        $sharedUser = User::factory()->create();
        (new ShareProjectToUserAction())(Project::find(1), $sharedUser);

        $this->actingAs($sharedUser)
            ->get(route('project.show', ['project' => 1]))
            ->assertStatus(200);
    }

    public function test_its_forbidden_for_user_without_access()
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

        $this->actingAs(User::factory()->create())
            ->get(route('project.show', ['project' => 1]))
            ->assertForbidden();
    }

    public function test_its_forbidden_for_guest()
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

        $this->get(route('project.show', ['project' => 1]))
            ->assertRedirect('login');

    }

    public function test_it_display_tasks()
    {
        $user = User::factory()
            ->has(Project::factory(['id' => 1])->afterCreating(function (Project $project, User $user) {
                Task::factory(3)
                    ->sequence(['title' => 'Task 1'], ['title' => 'Task 2'], ['title' => 'Task 3'])
                    ->for($user, 'author')
                    ->for($project, 'project')
                    ->create();
            })
                , 'projects')
            ->create();
        $this->actingAs($user);

        $this->get(route('project.show', ['project' => 1]))
            ->assertStatus(200)
            ->assertInertia(fn (Assert $page) => $page
                ->component('Project')
                ->has('actualTasks', 3)
            );

//        Livewire::actingAs($user)
//            ->test(TasksListPage::class, ['project' => Project::find(1)])
//            ->assertSee(['Task 1', 'Task 2', 'Task 3']);
    }

    public function test_it_create_new_task()
    {
        $user = User::factory()
            ->has(Project::factory(['id' => 1])->afterCreating(function (Project $project, User $user) {
                Task::factory(3)
                    ->for($user, 'author')
                    ->for($project, 'project')
                    ->create();
            })
                , 'projects')
            ->create();
        $this->actingAs($user);

        $this->post(route('task.store'), ['title' => 'New Task', 'project_id' => 1])
            ->assertStatus(302);

        $this->assertDatabaseHas('tasks', ['title' => 'New Task', 'project_id' => 1, 'user_id' => $user->id]);
    }

    public function test_it_sort_tasks()
    {
        $user = User::factory()
            ->has(Project::factory(['id' => 1])->afterCreating(function (Project $project, User $user) {
                Task::factory(4)
                    ->for($user, 'author')
                    ->for($project, 'project')
                    ->sequence(
                        ['title' => 'Task #1', 'created_at' => now()->subDays(10), 'deadline_date' => now()->subDays(10)],
                        ['title' => 'Task #2', 'created_at' => now()->subDays(5), 'deadline_date' => null],
                        ['title' => 'Task #3', 'created_at' => now()->subDays(2), 'deadline_date' => now()->subDays(2)],
                        ['title' => 'Task #4', 'created_at' => now(), 'deadline_date' => now()->subDays(5)]
                    )
                    ->create();
            })
                , 'projects')
            ->create();
        $this->actingAs($user);

        $this->get(route('project.show', ['project' => 1]))
            ->assertInertia(function (Assert $page) {
                $page->component('Project');
                $page->has('actualTasks')->whereAll([
                    'actualTasks.0.title' => 'Task #4',
                    'actualTasks.1.title' => 'Task #3',
                    'actualTasks.2.title' => 'Task #2',
                    'actualTasks.3.title' => 'Task #1',
                ]);
            });

        $this->get(route('project.show', ['project' => 1, 'sorting' => 'deadline']))
            ->assertInertia(function (Assert $page) {
                $page->component('Project');
                $page->has('actualTasks')->whereAll([
                    'actualTasks.0.title' => 'Task #1',
                    'actualTasks.1.title' => 'Task #4',
                    'actualTasks.2.title' => 'Task #3',
                    'actualTasks.3.title' => 'Task #2',
                ]);
            });

        $this->get(route('project.show', ['project' => 1, 'sorting' => 'created_asc']))
            ->assertInertia(function (Assert $page) {
                $page->component('Project');
                $page->has('actualTasks')->whereAll([
                    'actualTasks.0.title' => 'Task #1',
                    'actualTasks.1.title' => 'Task #2',
                    'actualTasks.2.title' => 'Task #3',
                    'actualTasks.3.title' => 'Task #4',
                ]);
            });

    }


}
