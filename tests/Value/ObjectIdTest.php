<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value;

use DigipolisGent\Flanders\BasicRegisters\Value\ObjectId;
use InvalidArgumentException;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\ObjectId
 */
class ObjectIdTest extends TestCase
{

    /**
     * Exception is thrown when value is not greater than 0.
     *
     * @param int $value
     *   The object id value to test.
     * @param bool $expectException
     *   Should the value trigger an exception.
     *
     * @dataProvider objectIdValueProvider
     *
     * @test
     */
    public function objectIdValueShouldBeGreaterThanZero(int $value, bool $expectException): void
    {
        if ($expectException) {
            $this->expectException(InvalidArgumentException::class);
        }

        new ObjectId($value);
        $this->assertFalse($expectException, 'Value dit not trigger an exception.');
    }

    /**
     * Dataprovider to test the value assertion.
     *
     * @return array
     *   Each record in the array contains:
     *   - int : The value to test.
     *   - bool : Should the code trigger an exception.
     */
    public function objectIdValueProvider(): array
    {
        return [
            [-1, true],
            [0, true],
            [1, false],
        ];
    }

    /**
     * Not the same values if id values are not the same.
     *
     * @test
     */
    public function notTheSameIfValuesAreDifferent(): void
    {
        $objectId = new ObjectId(123);
        $otherObjectId = new ObjectId(456);
        $this->assertFalse($objectId->sameValueAs($otherObjectId));
    }

    /**
     * Same value if the share the same id value.
     *
     * @test
     */
    public function sameValueIfIdValueIsTheSame(): void
    {
        $objectId = new ObjectId(123);
        $sameObjectId = new ObjectId(123);
        $this->assertTrue($objectId->sameValueAs($sameObjectId));
    }

    /**
     * Id is returned as string.
     *
     * @test
     */
    public function castToStringReturnsId(): void
    {
        $objectId = new ObjectId(123);
        $this->assertSame('123', (string) $objectId);
    }
}
