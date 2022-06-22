<?php

namespace Tests\Feature;

use App\Actions\ShareProjectToUserAction;
use App\Http\Livewire\ProjectEditWindow;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class ProjectEditWindowTest extends TestCase
{
    use RefreshDatabase;

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
            ->assertSeeLivewire(ProjectEditWindow::class);
    }

    public function test_it_can_change_project_info()
    {
        $user = User::factory()
            ->has(
                Project::factory(['id' => 1])
                    ->has(Task::factory(3),
                        'tasks'),
                'projects')
            ->create();

        Livewire::actingAs($user)
            ->test(ProjectEditWindow::class, ['project' => Project::find(1)])
            ->set('project.title', 'This is new Project Title')
            ->set('project.description', 'This is new Project Description')
            ->call('saveProject');

        $this->assertDatabaseHas('projects', [
           'title' =>  'This is new Project Title',
           'description' => 'This is new Project Description',
        ]);
    }

    public function test_project_title_is_required()
    {
        $user = User::factory()
            ->has(
                Project::factory(['id' => 1])
                    ->has(Task::factory(3),
                        'tasks'),
                'projects')
            ->create();

        Livewire::actingAs($user)
            ->test(ProjectEditWindow::class, ['project' => Project::find(1)])
            ->set('project.title', '')
            ->set('project.description', 'This is new Project Description')
            ->call('saveProject')
            ->assertHasErrors('project.title');
    }

    public function test_project_cannot_be_changed_by_non_owner()
    {
        User::factory()
            ->has(
                Project::factory(['id' => 1])
                    ->has(Task::factory(3),
                        'tasks'),
                'projects')
            ->create();

        $user = User::factory()->create();

        Livewire::actingAs($user)
            ->test(ProjectEditWindow::class, ['project' => Project::find(1)])
            ->set('project.title', 'This is new Project Title')
            ->set('project.description', 'This is new Project Description')
            ->call('saveProject')
            ->assertForbidden();

        (new ShareProjectToUserAction())(Project::find(1), $user);
        Livewire::actingAs($user)
            ->test(ProjectEditWindow::class, ['project' => Project::find(1)])
            ->set('project.title', 'This is new Project Title')
            ->set('project.description', 'This is new Project Description')
            ->call('saveProject')
            ->assertForbidden();
    }
}
