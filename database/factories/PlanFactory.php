<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Plan;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Plan>
 */
class PlanFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name'        => $this->faker->name(),
            'slug'        => $this->faker->slug(),
            'description' => $this->faker->text(),
            'trial_days'  => 0,
            'is_active'   => $this->faker->boolean(),
        ];
    }
}
