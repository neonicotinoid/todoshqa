<?php

namespace Tests\Feature;

use App\Models\Project;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_can_create_task_in_own_project()
    {
        $user = User::factory()->has(Project::factory(['id' => 1]), 'projects')->create();
        $this->actingAs($user);

        $this->post(route('task.store'), [
            'project_id' => 1,
            'title' => 'This is new task',
        ])->assertStatus(302);

        $this->assertDatabaseHas('tasks', [
            'title' => 'This is new task',
            'user_id' => $user->id,
            'project_id' => 1,
        ]);
    }

    public function test_guest_cant_create_task()
    {
        $this->post(route('task.store'), [
            'project_id' => 1,
            'title' => 'This is new task',
        ])->assertRedirect('/login');

        $this->assertDatabaseMissing('tasks', [
            'title' => 'This is new task',
        ]);
    }

    public function test_user_cant_create_task_in_someone_else_project()
    {
        User::factory()->has(Project::factory(['id' => 1]), 'projects')->create();
        $user = User::factory()->create();
        $this->actingAs($user);

        $this->postJson(route('task.store'), [
            'project_id' => 1,
            'title' => 'New task in project',
        ])->assertStatus(403);

        $this->assertDatabaseMissing('tasks', [
            'project_id' => 1,
            'title' => 'New task in project',
        ]);
    }

    public function test_task_title_is_required()
    {
        $this->actingAs(User::factory()->has(Project::factory(['id' => 1]), 'projects')->create());
        $this->post(route('task.store'), [
            'project_id' => 1,
            'title' => '',
        ])->assertSessionHasErrors('title');
    }

    public function test_user_can_create_task_in_shared_project()
    {
        $user_with_access = User::factory()->create();
        Project::factory(['id' => 1])
            ->for(User::factory(), 'user')
            ->hasAttached(collect([$user_with_access]), [], 'users')
            ->create();
        $this->actingAs($user_with_access);

        $this->post(route('task.store'), [
            'project_id' => 1,
            'title' => 'New task in shared project',
        ])->assertStatus(302);

        $this->assertDatabaseHas('tasks', [
            'title' => 'New task in shared project',
            'project_id' => 1,
            'user_id' => $user_with_access->id,
        ]);
    }
}
