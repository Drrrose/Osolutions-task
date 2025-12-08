<?php

namespace Database\Factories;

use Carbon\Carbon;
use App\Models\Category;
use App\Enums\TaskPriority;
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
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(4),
            'description' => $this->faker->paragraph(),
            'priority' => $this->faker->randomElement(TaskPriority::cases()),
            'due_date' => $this->faker->dateTimeBetween(Carbon::now(),Carbon::now()->addMonth()),
            'completed' => $this->faker->boolean(30),
            'category_id' => Category::inRandomOrder()->first()?->id, // Assign a random existing category and using php 8+ null safe in case there are no categories
        ];
    }
}
