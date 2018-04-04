<?php

namespace Minix\Support\Tests\Unit;

use Minix\Support\Tests\Fake\FakeModelAttribute;
use Tests\TestCase;

class ModelAttributeTest extends TestCase
{
    /** @test */
    public function can_find_valid_relationship_attributes()
    {
        $this->assertTrue(FakeModelAttribute::isRelation(FakeModelAttribute::RELATION_ONE));
        $this->assertTrue(FakeModelAttribute::isRelation(FakeModelAttribute::RELATION_TWO));
        $this->assertFalse(FakeModelAttribute::isRelation(FakeModelAttribute::ONE));
    }

    /** @test */
    public function can_transform_an_attribute_to_a_foreign_key_id()
    {
        $this->assertEquals(
            'relation_one_id',
            FakeModelAttribute::toForeignKey(FakeModelAttribute::RELATION_ONE)
        );

        $this->assertEquals(
            'relation_two_id',
            FakeModelAttribute::toForeignKey(FakeModelAttribute::RELATION_TWO)
        );
    }
}