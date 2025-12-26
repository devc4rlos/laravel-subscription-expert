<?php

namespace Tests\Feature;

use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Database\QueryException;
use Tests\TestCase;

class SubscriptionIntegrityTest extends TestCase
{
    use RefreshDatabase;

    public function test_plan_can_retrieve_its_associated_subscriptions()
    {
        $plan = Plan::factory()->create();
        Subscription::factory()->count(3)->create(['plan_id' => $plan->id]);

        $this->assertCount(3, $plan->subscriptions);
        $this->assertInstanceOf(Subscription::class, $plan->subscriptions->first());
    }

    public function test_user_can_retrieve_its_subscriptions()
    {
        $user = User::factory()->create();
        Subscription::factory()->count(2)->create(['user_id' => $user->id]);

        $this->assertCount(2, $user->subscriptions);
        $this->assertInstanceOf(Subscription::class, $user->subscriptions->first());
    }

    public function test_deleting_user_automatically_removes_its_associated_subscriptions()
    {
        $user = User::factory()->create();
        $subscription = Subscription::factory()->create(['user_id' => $user->id]);

        $user->delete();

        $this->assertDatabaseMissing('subscriptions', ['id' => $subscription->id]);
    }

    public function test_deleting_plan_automatically_removes_its_associated_subscriptions()
    {
        $plan = Plan::factory()->create();
        $subscription = Subscription::factory()->create(['plan_id' => $plan->id]);

        $plan->delete();

        $this->assertDatabaseMissing('subscriptions', ['id' => $subscription->id]);
    }

    public function test_subscription_cannot_be_created_without_valid_user_id()
    {
        $this->expectException(QueryException::class);

        Subscription::create([
            'plan_id' => Plan::factory()->create()->id,
            'status' => 'active',
        ]);
    }

    public function test_subscription_cannot_be_created_without_valid_plan_id()
    {
        $this->expectException(QueryException::class);

        Subscription::create([
            'user_id' => User::factory()->create()->id,
            'status' => 'active',
        ]);
    }
}