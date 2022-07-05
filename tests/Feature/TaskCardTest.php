<?php

namespace Tests\Feature;

use App\Actions\ShareProjectToUserAction;
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

    public function test_it_can_complete_task()
    {
        $user = User::factory()
            ->has(Project::factory(['id' => 1])->afterCreating(function (Project $project, User $user) {
                Task::factory(['id' => 1])
                    ->for($user, 'author')
                    ->for($project, 'project')
                    ->create();
            })
                , 'projects')
            ->create();

        Livewire::actingAs($user)
            ->test(TaskCard::class, ['task' => Task::find(1)])
            ->call('toggleTaskState');

        $this->assertNotNull(Task::find(1)->completed_at);
    }

    public function test_random_user_cant_complete_task()
    {
        User::factory()
            ->has(Project::factory(['id' => 1])->afterCreating(function (Project $project, User $user) {
                Task::factory(['id' => 1])
                    ->for($user, 'author')
                    ->for($project, 'project')
                    ->create();
            })
                , 'projects')
            ->create();

        $randomUser = User::factory()->create();
        $this->actingAs($randomUser);

        Livewire::actingAs($randomUser)
            ->test(TaskCard::class, ['task' => Task::find(1)])
            ->call('toggleTaskState')
            ->assertForbidden();
    }

    public function test_user_with_shared_access_can_complete_task()
    {
        User::factory()
            ->has(Project::factory(['id' => 1])->afterCreating(function (Project $project, User $user) {
                Task::factory(['id' => 1])
                    ->for($user, 'author')
                    ->for($project, 'project')
                    ->create();
            })
                , 'projects')
            ->create();

        $randomUser = User::factory()->create();
        (new ShareProjectToUserAction())(Project::find(1), $randomUser);
        $this->actingAs($randomUser);

        Livewire::actingAs($randomUser)
            ->test(TaskCard::class, ['task' => Task::find(1)])
            ->call('toggleTaskState')
            ->assertStatus(200);
    }

}
