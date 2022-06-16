<?php

namespace Database\Factories;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'title' => $this->faker->text(120),
            'description' => $this->faker->boolean(50) ? $this->faker->text(250) : null,
        ];
    }

    public function completed()
    {
        return $this->state(function (array $attributes) {
            return [
                'completed_at' => $this->faker->dateTimeBetween('-120 days')
            ];
        });
    }

    public function overdue()
    {
        return $this->state(function (array $attributes) {
            return [
                'completed_at' => null,
                'deadline_date' => now()->subDays(20)
            ];
        });
    }
}
