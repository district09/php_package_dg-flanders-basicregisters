<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value;

use DigipolisGent\Flanders\BasicRegisters\Value\ObjectId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\ObjectId
 */
class ObjectIdTest extends TestCase
{

    /**
     * Exception is thrown when id is not greater than 0.
     *
     * @test
     */
    public function exceptionWhenIdIsZero(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new ObjectId(0);
    }

    /**
     * Not the same values if id values are not the same.
     *
     * @test
     */
    public function notTheSameIfValuesAreDifferent(): void
    {
        $id = new ObjectId(123);
        $notTheSameId = new ObjectId(456);
        $this->assertFalse($id->sameValueAs($notTheSameId));
    }

    /**
     * Same value if the share the same id value.
     *
     * @test
     */
    public function sameValueIfIdValueIsTheSame(): void
    {
        $id = new ObjectId(123);
        $sameId = new ObjectId(123);
        $this->assertTrue($id->sameValueAs($sameId));
    }

    /**
     * Id is returned as string.
     *
     * @test
     */
    public function idIsReturnedAsStringValue(): void
    {
        $id = new ObjectId(123);
        $this->assertSame('123', (string) $id);
    }
}
