<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value\Address;

use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressId;
use InvalidArgumentException;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\AbstractId
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressId
 */
class AddressIdTest extends TestCase
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

        new AddressId($value);
        $this->assertFalse($expectException, 'Value dit not trigger an exception.');
    }

    /**
     * Data provider to test the value assertion.
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
        $addressId = new AddressId(123);
        $otherObjectId = new AddressId(456);
        $this->assertFalse($addressId->sameValueAs($otherObjectId));
    }

    /**
     * Same value if the share the same id value.
     *
     * @test
     */
    public function sameValueIfIdValueIsTheSame(): void
    {
        $addressId = new AddressId(123);
        $sameObjectId = new AddressId(123);
        $this->assertTrue($addressId->sameValueAs($sameObjectId));
    }

    /**
     * Id is returned as string.
     *
     * @test
     */
    public function castToStringReturnsId(): void
    {
        $addressId = new AddressId(123);
        $this->assertSame('123', (string) $addressId);
    }
}
