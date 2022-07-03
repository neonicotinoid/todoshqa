<?php

namespace Tests\Feature;

use App\Http\Livewire\TaskCard;
use App\Http\Livewire\TasksListPage;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class TaskCardTest extends TestCase
{

    use RefreshDatabase;

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
            ->test(TaskCard::class, ['task' => Task::find(1)])
            ->call('toggleTaskState');

        $this->assertNotNull(Task::find(1)->completed_at);
    }

}
