<?php

declare(strict_types=1);

namespace App\Models;

use Database\Factories\PlanFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
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
}
