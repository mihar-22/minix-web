<?php

namespace Minix\Support\Tests\Unit;

use Minix\Support\Tests\Fake\FakeEnum;
use Tests\TestCase;

class EnumTest extends TestCase
{
    /** @test */
    public function values_should_contain_all_constants()
    {
        $values = FakeEnum::values();

        $this->assertEquals(3, count($values));
        $this->assertTrue(in_array(FakeEnum::ONE, $values));
        $this->assertTrue(in_array(FakeEnum::TWO, $values));
        $this->assertTrue(in_array(FakeEnum::THREE, $values));
    }

    /** @test */
    public function exists_should_find_valid_values()
    {
        $this->assertTrue(FakeEnum::exists(FakeEnum::ONE));
        $this->assertFalse(FakeEnum::exists('InvalidValue'));
    }
}

