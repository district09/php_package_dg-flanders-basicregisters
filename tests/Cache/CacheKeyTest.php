<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Cache;

use DigipolisGent\Flanders\BasicRegisters\Cache\CacheKey;
use DigipolisGent\Flanders\BasicRegisters\Value\Address\AddressId;
use DigipolisGent\Tests\Flanders\BasicRegisters\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Cache\CacheKey
 */
class CacheKeyTest extends TestCase
{
    /**
     * Cache key can be created from string.
     *
     * @test
     */
    public function cacheKeyCanBeCreatedFromString(): void
    {
        $cacheKey = new CacheKey('FooBar');

        $this->assertEquals(
            'FlandersBasicRegister:FooBar',
            $cacheKey->value()
        );
    }

    /**
     * Cache key can be created from ID value.
     *
     * @test
     */
    public function cacheKeyCanBeCreatedFromId(): void
    {
        $addressId = new AddressId(123456);
        $cacheKey = CacheKey::fromId($addressId);

        $this->assertEquals(
            'FlandersBasicRegister:AddressId:123456',
            $cacheKey->value()
        );
    }

    /**
     * Cache object can be casted to a string.
     *
     * @test
     */
    public function cacheKeyCanBeCastedToString(): void
    {
        $cacheKey = new CacheKey('FooBar');

        $this->assertEquals(
            'FlandersBasicRegister:FooBar',
            (string) $cacheKey
        );
    }
}
