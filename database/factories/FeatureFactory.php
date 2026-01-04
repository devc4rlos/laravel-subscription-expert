<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\FeatureEnum;
use App\Models\Feature;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Feature>
 */
class FeatureFactory extends Factory
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
            'code'        => $this->faker->randomElement(FeatureEnum::cases()),
            'description' => $this->faker->text(),
        ];
    }
}
