<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\CurrencyEnum;
use App\Enums\IntervalEnum;
use Database\Factories\PriceFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Price extends Model
{
    /** @use HasFactory<PriceFactory> */
    use HasFactory;

    protected $fillable = [
        'plan_id',
        'amount',
        'currency',
        'interval',
        'is_active',
    ];

    protected $attributes = [
        'is_active' => true,
    ];

    protected $casts = [
        'amount'    => 'integer',
        'currency'  => CurrencyEnum::class,
        'interval'  => IntervalEnum::class,
        'is_active' => 'boolean',
    ];
}
