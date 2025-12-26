<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    public function run(): void
    {
        $plans = [
            [
                'name' => 'Basic',
                'slug' => 'basic',
                'description' => 'Ideal for those just starting their journey.',
                'price_cents' => 1990,
                'status' => 'active',
            ],
            [
                'name' => 'Pro',
                'slug' => 'pro',
                'description' => 'Complete access to all professional tools.',
                'price_cents' => 4990,
                'status' => 'active',
            ],
            [
                'name' => 'Diamond',
                'slug' => 'diamond',
                'description' => 'Priority support and exclusive enterprise resources.',
                'price_cents' => 9990,
                'status' => 'active',
            ],
        ];

        foreach ($plans as $plan) {
            Plan::updateOrCreate(['slug' => $plan['slug']], $plan);
        }
    }
}
