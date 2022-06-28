<?php

namespace Tests\Feature;

use App\Actions\ShareProjectToUserAction;
use App\Http\Livewire\TasksListPage;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class TasksListPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_accessible_for_owner()
    {
        $this->actingAs(User::factory()
            ->has(
                Project::factory(['id' => 1])
                    ->has(Task::factory(3),
                        'tasks'),
                'projects')
            ->create());

        $this->get(route('project.show', ['project' => 1]))
            ->assertStatus(200);
    }

    public function test_it_accessible_for_shared_user()
    {
        User::factory()
            ->has(
                Project::factory(['id' => 1])
                    ->has(Task::factory(3),
                        'tasks'),
                'projects')
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
            ->has(
                Project::factory(['id' => 1])
                    ->has(Task::factory(3),
                        'tasks'),
                'projects')
            ->create();

        $this->actingAs(User::factory()->create())
            ->get(route('project.show', ['project' => 1]))
            ->assertForbidden();
    }

    public function test_its_forbidden_for_guest()
    {
        User::factory()
            ->has(
                Project::factory(['id' => 1])
                    ->has(Task::factory(3),
                        'tasks'),
                'projects')
            ->create();

        $this->get(route('project.show', ['project' => 1]))
            ->assertRedirect('login');

    }

    public function test_it_renders_component()
    {
        $this->actingAs(User::factory()
            ->has(
                Project::factory(['id' => 1])
                    ->has(Task::factory(3),
                    'tasks'),
                'projects')
            ->create());

        $this->get(route('project.show', ['project' => 1]))
            ->assertSeeLivewire(TasksListPage::class);
    }

    public function test_it_display_tasks()
    {
        $user = User::factory()
            ->has(
                Project::factory(['id' => 1])
                    ->has(Task::factory(3)->sequence(['title' => 'Task 1'], ['title' => 'Task 2'], ['title' => 'Task 3']),
                        'tasks'),
                'projects')
            ->create();

        Livewire::actingAs($user)
            ->test(TasksListPage::class, ['project' => Project::find(1)])
            ->assertSee(['Task 1', 'Task 2', 'Task 3']);
    }

    public function test_it_create_new_task()
    {
        $user = User::factory()
            ->has(
                Project::factory(['id' => 1])
                    ->has(Task::factory(),
                        'tasks'),
                'projects')
            ->create();

        Livewire::actingAs($user)
            ->test(TasksListPage::class, ['project' => Project::find(1)])
            ->set('newTaskTitle', 'This is new task title')
            ->call('addNewTask')
            ->assertSee('This is new task title')
            ->assertSet('newTaskTitle', '');
    }

    public function test_it_can_toggle_task()
    {
        $user = User::factory()
            ->has(
                Project::factory(['id' => 1])
                    ->has(Task::factory(['id' => 1]),
                        'tasks'),
                'projects')
            ->create();

        Livewire::actingAs($user)
            ->test(TasksListPage::class, ['project' => Project::find(1)])
            ->call('toggleTaskState', Task::find(1));

        $this->assertNotNull(Task::find(1)->completed_at);
    }

    /**
     * @dataProvider sortedTaskDataProvider
     */
    public function test_it_sort_tasks_by_created_at(string $sorting_type, array $attributes)
    {
        $user = User::factory()
            ->has(
                Project::factory(['id' => 1])
                    ->has(Task::factory(4)->sequence(
                        fn($sequence) => $attributes[$sequence->index] ),
                        'tasks'),
                'projects')
            ->create();

        Livewire::actingAs($user)
            ->test(TasksListPage::class, ['project' => Project::find(1)])
            ->set('sortBy', $sorting_type)
            ->assertSeeInOrder(['Task #1', 'Task #2', 'Task #3', 'Task #4']);
    }

    public function sortedTaskDataProvider(): array
    {
        return [
            'Sort by created_at' => ['created',
           [
                ['title' => 'Task #1', 'created_at' => now()->subDays(10)],
                ['title' => 'Task #2', 'created_at' => now()->subDays(5)],
                ['title' => 'Task #3', 'created_at' => now()->subDays(2)],
                ['title' => 'Task #4', 'created_at' => now()]]
            ],
            'Sort by deadline' => ['deadline',
                [
                    ['title' => 'Task #1', 'deadline_date' => now()->subDays(10)],
                    ['title' => 'Task #2', 'deadline_date' => now()->subDays(5)],
                    ['title' => 'Task #3', 'deadline_date' => now()->subDays(2)],
                    ['title' => 'Task #4', 'deadline_date' => null],
                ],
                ]
        ];
    }

}
