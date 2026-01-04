<?php

declare(strict_types=1);

namespace Tests\Unit\Models;

use App\Enums\FeatureEnum;
use App\Models\Feature;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FeatureTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_casts_attributes_to_native_types(): void
    {
        $feature = Feature::factory()->create();

        $this->assertInstanceOf(FeatureEnum::class, $feature->code);
    }
}
