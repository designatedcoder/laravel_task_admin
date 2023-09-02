<?php

namespace Database\Factories;

use Illuminate\Support\Arr;
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
    public function definition(): array {
        $boolean = [true, false];
        return [
            'description' => $this->faker->sentence(),
            'command' => $this->faker->sentence(),
            'expression' => '5 0 * 8 *',
            'is_active' => Arr::random($boolean),
            'dont_overlap' => false,
            'run_in_maintenance' => false,
            'notification_email' => $this->faker->unique()->safeEmail(),
        ];
    }
}
