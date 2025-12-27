<?php

namespace App\Traits;

use App\Models\Plan;
use App\Models\Subscription;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasSubscription
{
    public function subscriptions(): HasMany
    {
        return $this->hasMany(Subscription::class);
    }

    public function isActive(): bool
    {
        $subscription = $this->currentSubscription();

        if (! $subscription) {
            return false;
        }

        if ($subscription->status === 'active') {
            return $subscription->ends_at?->isFuture() ?? true;
        }

        if ($subscription->status === 'trialing') {
            return $subscription->trial_ends_at?->isFuture() ?? true;
        }

        return false;
    }

    public function currentSubscription(): ?Subscription
    {
        return $this->subscriptions()
            ->whereIn('status', ['active', 'trialing'])
            ->latest()
            ->first();
    }

    public function currentPlan(): ?Plan
    {
        return $this->currentSubscription()?->plan;
    }

    public function isPlan(string $slug): bool
    {
        return $this->currentPlan()?->slug === $slug;
    }
}