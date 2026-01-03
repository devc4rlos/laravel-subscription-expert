<?php

declare(strict_types=1);

namespace App\Enums;

enum IntervalEnum: string
{
    case MONTHLY = 'monthly';
    case YEARLY = 'yearly';
    case ONCE = 'once';
}
