<?php

namespace Tests\Feature;

use App\Http\Livewire\TasksListPage;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class TasksListPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_renders_component()
    {
        $this->actingAs(User::factory()
            ->has(
                Project::factory()
                    ->has(Task::factory(3),
                    'tasks'),
                'projects')
            ->create());

        $this->get(route('project.tasks', ['project' => 1]))
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

}
