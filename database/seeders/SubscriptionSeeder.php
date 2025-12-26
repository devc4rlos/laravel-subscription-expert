<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\Subscription;
use App\Models\User;
use Illuminate\Database\Seeder;

class SubscriptionSeeder extends Seeder
{
    public function run(): void
    {
        $basicPlan = Plan::where('slug', 'basic')->first();
        $proPlan = Plan::where('slug', 'pro')->first();

        $activeUser = User::firstOrCreate(
            ['email' => 'active@example.com'],
            [
                'name' => 'Active User',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        Subscription::updateOrCreate(
            ['user_id' => $activeUser->id],
            [
                'plan_id' => $proPlan->id,
                'status' => 'active',
                'ends_at' => now()->addMonth(),
                'trial_ends_at' => null,
            ]
        );

        $trialUser = User::firstOrCreate(
            ['email' => 'trial@example.com'],
            [
                'name' => 'Trial User',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        Subscription::updateOrCreate(
            ['user_id' => $trialUser->id],
            [
                'plan_id' => $basicPlan->id,
                'status' => 'trialing',
                'trial_ends_at' => now()->addDays(7),
                'ends_at' => null,
            ]
        );

        $expiredUser = User::firstOrCreate(
            ['email' => 'expired@example.com'],
            [
                'name' => 'Expired User',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );

        Subscription::updateOrCreate(
            ['user_id' => $expiredUser->id],
            [
                'plan_id' => $basicPlan->id,
                'status' => 'expired',
                'ends_at' => now()->subDay(),
                'trial_ends_at' => null,
            ]
        );
    }
}