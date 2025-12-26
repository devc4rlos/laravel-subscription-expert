<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price_cents',
        'status',
    ];

    protected $casts = [
        'price_cents' => 'integer',
    ];
}
