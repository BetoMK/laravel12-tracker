<?php

namespace PragmaRX\Tracker\Tests\Unit;

use PHPUnit\Framework\TestCase;
use PragmaRX\Tracker\Support\DeviceAttributes;

class DeviceAttributesTest extends TestCase
{
    /** @test */
    public function it_casts_integer_model_zero_to_string()
    {
        $normalized = DeviceAttributes::normalize([
            'kind' => 'Computer',
            'model' => 0,
            'platform' => 'Other',
            'platform_version' => '',
            'is_mobile' => false,
        ]);

        $this->assertSame('0', $normalized['model']);
        $this->assertSame('Computer', $normalized['kind']);
        $this->assertSame('Other', $normalized['platform']);
        $this->assertSame('', $normalized['platform_version']);
        $this->assertFalse($normalized['is_mobile']);
    }

    /** @test */
    public function it_converts_false_and_null_string_fields_to_empty_string()
    {
        $normalized = DeviceAttributes::normalize([
            'kind' => 'Computer',
            'model' => false,
            'platform' => null,
            'platform_version' => null,
        ]);

        $this->assertSame('', $normalized['model']);
        $this->assertSame('', $normalized['platform']);
        $this->assertSame('', $normalized['platform_version']);
    }

    /** @test */
    public function it_keeps_bot_and_other_string_models_unchanged()
    {
        $normalized = DeviceAttributes::normalize([
            'kind' => 'Computer',
            'model' => 'Bot',
            'platform' => 'Other',
            'platform_version' => '1.0',
        ]);

        $this->assertSame('Bot', $normalized['model']);
        $this->assertSame('1.0', $normalized['platform_version']);
    }
}
