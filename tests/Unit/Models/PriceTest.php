<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Enums\CurrencyEnum;
use App\Enums\IntervalEnum;
use App\Models\Plan;
use App\Models\Price;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PriceTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_sets_default_values(): void
    {
        $price = Price::create([
            'plan_id'  => Plan::factory()->create()->id,
            'amount'   => 1000,
            'currency' => CurrencyEnum::BRL,
            'interval' => IntervalEnum::ONCE,
        ]);

        $this->assertTrue($price->is_active);
    }

    public function test_it_casts_attributes_to_native_types(): void
    {
        $price = Price::factory()->create([
            'is_active' => 1,
            'currency'  => CurrencyEnum::BRL,
            'interval'  => IntervalEnum::MONTHLY,
        ]);

        $this->assertTrue($price->is_active);
        $this->assertInstanceOf(CurrencyEnum::class, $price->currency);
        $this->assertInstanceOf(IntervalEnum::class, $price->interval);
    }
}
