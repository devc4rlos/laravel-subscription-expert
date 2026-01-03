<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\CurrencyEnum;
use App\Enums\IntervalEnum;
use App\Models\Plan;
use App\Models\Price;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Price>
 */
class PriceFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'plan_id'   => Plan::factory(),
            'amount'    => $this->faker->numberBetween(int2: 100000),
            'currency'  => $this->faker->randomElement(CurrencyEnum::cases()),
            'interval'  => $this->faker->randomElement(IntervalEnum::cases()),
            'is_active' => $this->faker->boolean(),
        ];
    }
}
