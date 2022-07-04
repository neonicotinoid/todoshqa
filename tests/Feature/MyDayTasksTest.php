<?php

namespace Tests\Feature;

use App\Http\Livewire\MyDayTasksPage;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire;
use Tests\TestCase;

class MyDayTasksTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_renders_component()
    {

        $this->actingAs(User::factory()
            ->has(Project::factory()->afterCreating(function (Project $project, User $user) {
                Task::factory(3)
                    ->for($user, 'author')
                    ->for($project, 'project')
                    ->create();
            })
                , 'projects')
            ->create());

        $this->get(route('myDay'))
            ->assertStatus(200)
            ->assertSeeLivewire(MyDayTasksPage::class);
    }

    public function test_it_doesnt_render_for_guests()
    {
        $this->get(route('myDay'))
            ->assertStatus(302)
            ->assertRedirect('/login');
    }

    public function test_it_show_today_tasks()
    {
        $user = User::factory()->create();
        Task::factory(3)
            ->for(Project::factory()->for($user)->create(), 'project')
            ->for($user, 'author')
            ->myDay($user)
            ->sequence(
                ['title' => 'My Day Task #1'],
                ['title' => 'My Day Task #2'],
                ['title' => 'My Day Task #3']
            )
            ->create();

        Livewire::actingAs($user)
            ->test(MyDayTasksPage::class, ['user' => $user])
            ->assertSee(['My Day Task #1', 'My Day Task #2', 'My Day Task #3']);
    }

    public function test_it_show_today_tasks_from_different_projects()
    {
        $user = User::factory()->create();
        Project::factory(2)
            ->has(Task::factory(3)->myDay($user)
                ->for($user, 'author')
                ->sequence(
                ['title' => 'My Day Task #1'],
                ['title' => 'My Day Task #2'],
                ['title' => 'My Day Task #3'],
                ['title' => 'My Day Task #4'],
                ['title' => 'My Day Task #5'],
                ['title' => 'My Day Task #6'],
            ), 'tasks')
            ->for($user, 'user')
            ->create();

        Livewire::actingAs($user)
            ->test(MyDayTasksPage::class, ['user' => $user])
            ->assertSee([
                'My Day Task #1',
                'My Day Task #2',
                'My Day Task #3',
                'My Day Task #4',
                'My Day Task #5',
                'My Day Task #6',
            ]);
    }


}
