<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {


        User::factory(10)
            ->has(Project::factory(3)->afterCreating(function (Project $project, User $user) {
                Task::factory(5)
                    ->for($user, 'author')
                    ->for($project, 'project')
                    ->create();
            })
            , 'projects')
            ->create();
    }
}
