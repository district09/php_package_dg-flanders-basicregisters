<?php

declare(strict_types=1);

namespace DigipolisGent\Tests\Flanders\BasicRegisters\Value;

use DigipolisGent\Flanders\BasicRegisters\Value\Address;
use DigipolisGent\Flanders\BasicRegisters\Value\Addresses;
use DigipolisGent\Flanders\BasicRegisters\Value\FullAddress;
use DigipolisGent\Flanders\BasicRegisters\Value\GeographicalName;
use DigipolisGent\Flanders\BasicRegisters\Value\LanguageCode;
use DigipolisGent\Flanders\BasicRegisters\Value\ObjectId;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigipolisGent\Flanders\BasicRegisters\Value\Addresses
 */
class AddressesTest extends TestCase
{
    /**
     * Casting to string returns all address as string.
     *
     * @test
     */
    public function castToStringReturnsAllAddressAsString(): void
    {
        $address1 = new Address(
            new ObjectId(123),
            '123',
            '',
            new FullAddress(
                new GeographicalName(new LanguageCode('NL'), 'Foo 123, 9123 Bar')
            )
        );
        $address2 = new Address(
            new ObjectId(124),
            '124',
            '',
            new FullAddress(
                new GeographicalName(new LanguageCode('NL'), 'Foo 124, 9123 Bar')
            )
        );
        $addresses = new Addresses($address1, $address2);

        $this->assertEquals(
            'Foo 123, 9123 Bar; Foo 124, 9123 Bar',
            (string) $addresses
        );
    }
}
