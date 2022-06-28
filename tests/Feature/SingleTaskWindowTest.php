<?php

namespace Tests\Feature;

use App\Http\Livewire\ProjectEditWindow;
use App\Http\Livewire\SingleTaskWindow;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Livewire\Livewire;

class SingleTaskWindowTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_renders()
    {
        $this->actingAs(User::factory()
            ->has(
                Project::factory(['id' => 1])
                    ->has(Task::factory(3),
                        'tasks'),
                'projects')
            ->create());

        $this->get(route('project.show', ['project' => 1]))
            ->assertSeeLivewire(SingleTaskWindow::class);
    }

    public function test_it_can_edit_task()
    {
        $user = User::factory()
            ->has(
                Project::factory(['id' => 1])
                    ->has(Task::factory(3),
                        'tasks'),
                'projects')
            ->create();

        $this->actingAs($user);
        $task = Task::first();

        Livewire::actingAs($user)
            ->test(SingleTaskWindow::class)
            ->emit('openTask', $task)
            ->assertSet('task', $task)
            ->set('task.title', 'Testable Title')
            ->call('saveTask')
            ->assertEmitted('task-updated');

        $this->assertDatabaseHas('tasks', ['title' => 'Testable Title']);
    }

}
