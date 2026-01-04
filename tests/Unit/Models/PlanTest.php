<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Models\Feature;
use App\Models\Plan;
use App\Models\Price;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PlanTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_generates_slug_from_name_when_missing(): void
    {
        $plan = Plan::factory()->create(['name' => 'Gold Plan', 'slug' => null]);

        $this->assertSame('gold-plan', $plan->slug);
    }

    public function test_it_uses_provided_slug(): void
    {
        $plan = Plan::factory()->create(['name' => 'Gold Plan', 'slug' => 'my-vip-plan']);

        $this->assertSame('my-vip-plan', $plan->slug);
    }

    public function test_it_sets_default_values(): void
    {
        $plan = Plan::factory()->create();

        $this->assertSame(0, $plan->trial_days);
    }

    public function test_it_casts_attributes_to_native_types(): void
    {
        $plan = Plan::factory()->create(['is_active' => 1, 'trial_days' => '7']);

        $this->assertTrue($plan->is_active);
        $this->assertSame(7, $plan->trial_days);
    }

    public function test_it_retrieves_only_active_prices(): void
    {
        $plan = Plan::factory()->create();

        Price::factory()->count(2)->create(['plan_id' => $plan->id, 'is_active' => true]);

        Price::factory()->create(['plan_id' => $plan->id, 'is_active' => false]);

        $this->assertCount(2, $plan->activePrices);

        $plan->activePrices->each(fn (Price $price) => $this->assertTrue($price->is_active));
    }

    public function test_it_can_attach_a_feature_to_a_plan_with_value(): void
    {
        $plan = Plan::factory()->create();
        $feature = Feature::factory()->create();
        $limitValue = '10';

        $plan->features()->attach($feature->id, ['value' => $limitValue]);

        $this->assertDatabaseHas('plan_feature', [
            'plan_id'    => $plan->id,
            'feature_id' => $feature->id,
            'value'      => $limitValue,
        ]);
    }

    public function test_it_can_retrieve_pivot_value_attribute(): void
    {
        $plan = Plan::factory()->create();
        $feature = Feature::factory()->create();
        $plan->features()->attach($feature->id, ['value' => 'true']);

        $attachedFeature = $plan->features->firstOrFail();

        $pivot = $attachedFeature->getRelation('pivot');

        $this->assertInstanceOf(Pivot::class, $pivot);

        $this->assertEquals('true', $pivot->getAttribute('value'));
    }
}
