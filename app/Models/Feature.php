<?php

declare(strict_types=1);

namespace App\Models;

use App\Enums\FeatureEnum;
use Database\Factories\FeatureFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Feature extends Model
{
    /** @use HasFactory<FeatureFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'description',
    ];

    protected $casts = [
        'code' => FeatureEnum::class,
    ];

    /** @return BelongsToMany<Plan, $this> */
    public function plan(): BelongsToMany
    {
        return $this->belongsToMany(Plan::class, 'plan_feature')
            ->withPivot('value');
    }
}
