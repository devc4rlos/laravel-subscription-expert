<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\PlanFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class Plan extends Model
{
    /** @use HasFactory<PlanFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'trial_days',
        'is_active',
    ];

    protected $attributes = [
        'trial_days' => 0,
        'is_active'  => true,
    ];

    protected $casts = [
        'trial_days' => 'integer',
        'is_active'  => 'boolean',
    ];

    protected static function booted(): void
    {
        static::creating(function (Plan $plan) {
            if (! $plan->slug) {
                $plan->slug = Str::slug($plan->name);
            }
        });
    }

    /** @return HasMany<Price, $this> */
    public function activePrices(): HasMany
    {
        return $this->prices()->where('is_active', true);
    }

    /** @return HasMany<Price, $this> */
    public function prices(): HasMany
    {
        return $this->hasMany(Price::class);
    }
}
